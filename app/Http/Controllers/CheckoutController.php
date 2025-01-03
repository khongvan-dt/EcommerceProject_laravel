<?php

namespace App\Http\Controllers;
use App\Models\AttributeValues;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\User;
use App\Models\Vouchers;
use App\Models\Discounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = json_decode(Cookie::get('cartData', '[]'), true);

        if (empty($cart)) {
            return view('share.checkout', ['cartIndex' => [], 'subTotal' => 0]);
        }

        $products = Products::whereIn('id', array_column($cart, 'productId'))->get();
        $colors = AttributeValues::whereIn('id', array_column($cart, 'colorId'))->get();
        $sizes = AttributeValues::whereIn('id', array_column($cart, 'sizeId'))->get();

        $cartIndex = [];
        $subTotal = 0;
        foreach ($cart as $cartItem) {
            if (!isset($cartItem['productId'])) continue; 

            $product = $products->firstWhere('id', $cartItem['productId']);
            $color = $colors->firstWhere('id', $cartItem['colorId']);
            $size = $sizes->firstWhere('id', $cartItem['sizeId']);

            if (!$product || !$color || !$size) {
                continue;
            }

            $price = ($color->priceOut + $size->priceOut) / 2;
            $discounts = Discounts::whereIn('productId', array_column($cart, 'productId'))
            ->where('status', 1)
            ->get();
            $activeDiscount = $discounts->firstWhere('productId', $cartItem['productId']);
            
            if ($activeDiscount) {
                $price = $price - ($price * $activeDiscount->discountPercentage / 100);
            }

            $itemTotal = $price * $cartItem['quantity'];
            $subTotal += $itemTotal;

            $cartIndex[] = [
                'product' => $product,
                'color' => $color,
                'size' => $size,
                'price' => $price,
                'quantity' => $cartItem['quantity'],
            ];
        }
       
        $total = 0;
        foreach ($cartIndex as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $voucherCode = session('voucher');
        $voucher = Vouchers::where('code', $voucherCode)->first();
        $total = $subTotal;
        if ($voucher) {
            $subTotal = $subTotal - ($subTotal * $voucher->discountPercentage / 100);
        }        return view('share.checkout', compact('cartIndex', 'subTotal','total'));
    }


    public function processCheckout(Request $request)
{
    $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'address' => 'required|string|max:500',
        'phone' => 'required|numeric|digits_between:10,15',
        'email' => 'required|email',
        'payment_method' => 'required|in:paymoney,VNPay',
        'password' => 'nullable|string|min:6',
    ]);

    try {
        // Register user if necessary
        if ($request->has('checkRegister') && $request->checkRegister) {
            $user = new User();
            $user->first_name = $request->firstName;
            $user->last_name = $request->lastName;
            $user->email = $request->email;
            $user->password =  Hash::make($request->password);
            $user->address = $request->address;
            $user->phone = $request->phone;
            $user->save();
            Auth::login($user);
        } else {
            $user = Auth::user();
        }

        $totalDiscountAmount = 0;
        $totalPrice = 0;
        
        $cart = json_decode(Cookie::get('cartData', '[]'), true);
        $products = Products::whereIn('id', array_column($cart, 'productId'))->get();
        $colors = AttributeValues::whereIn('id', array_column($cart, 'colorId'))->get();
        $sizes = AttributeValues::whereIn('id', array_column($cart, 'sizeId'))->get();
        
        $activeDiscounts = Discounts::whereIn('productId', array_column($cart, 'productId'))
            ->where('startDate', '<=', now())
            ->where('endDate', '>=', now())
            ->get();

        foreach ($cart as $cartItem) {
            $product = $products->firstWhere('id', $cartItem['productId']);
            $color = $colors->firstWhere('id', $cartItem['colorId']);
            $size = $sizes->firstWhere('id', $cartItem['sizeId']);

            if (!$product || !$color || !$size) {
                continue;
            }

            $basePrice = ($color->priceOut + $size->priceOut) / 2;
            $quantity = $cartItem['quantity'];
            $itemTotal = $basePrice * $quantity;

            $discount = $activeDiscounts->firstWhere('productId', $product->id);

            if ($discount) {
                $discountAmount = $itemTotal * ($discount->discountPercentage / 100);
                $totalDiscountAmount += $discountAmount;
            }

            $totalPrice += $itemTotal;
            $voucherCode = session('voucher');
            $voucher = Vouchers::where('code', $voucherCode)->first();
            $order = Orders::create([
                'userId' => $user ? $user->id : null,
                'paymentMethod' => $request->payment_method,
                'totalPrice' => $totalPrice,
                'discountAmount' => $discountAmount,
                'voucherCode' => $voucher->discountPercentage ?? 0,
                'status' => 'PENDING'
            ]);

            $basePrice = ($color->priceOut + $size->priceOut) / 2;

            $discountPercentage = 0;
            if ($discount) {
                $discountPercentage = $discount->discountPercentage;
                $basePrice = $basePrice * (1 - $discountPercentage / 100);
            }

            $totalItemPrice = $basePrice * $cartItem['quantity'];

            OrderDetails::create([
                'orderId' => $order->id,
                'productId' => $product->id,
                'sizeId' => $size->id,
                'colorId' => $color->id,
                'quantity' => $cartItem['quantity'],
                'price' => $basePrice,
                'discount_percentage' => $discountPercentage,
            ]);
        }

        Cookie::queue(Cookie::forget('cartData'));

         if ($voucher && $voucher->discountPercentage) {
             $voucher->quantity -= 1;
            $voucher->save();
        }
        session()->forget('voucher');
         if ($request->payment_method === 'VNPay') {
            return $this->createPayment($order->id);
        } else if ($request->payment_method === 'paymoney') {
            return $this->createMoney($order->id);
        }

    } catch (\Exception $e) {
        return redirect()->back()->withErrors([
            'error' => 'There was an error processing your order.',
            'exception' => $e->getMessage(),
        ]);
    }
}


    // public function createPayment($order_id)
    // {
    //     date_default_timezone_set('Asia/Ho_Chi_Minh');
    //     $order = Orders::find($order_id);
    //     $vnp_TmnCode = '96PV39NC';
    //     $vnp_HashSecret = 'ZYCTQITJBJSIYKRGUROFFNJHNQGCRSPZ';
    //     $vnp_ReturnUrl = 'http://127.0.0.1:8000/checkout/return';
    //     $vnp_TestUrl = 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html';
    //     $expire = date('YmdHis', strtotime('+1 hour'));
    //     $orderAmount = (int)$order->totalPrice * 1000;
    //     $inputData = [
    //         "vnp_Version" => "2.1.0",
    //         'vnp_TmnCode' => $vnp_TmnCode,
    //         'vnp_Amount' => $orderAmount * 100,
    //         'vnp_Command' => "pay",
    //         'vnp_CreateDate' => date('YmdHis'),
    //         "vnp_CurrCode" => "VND",
    //         "vnp_ExpireDate" => $expire,
    //         'vnp_IpAddr' => request()->ip(),
    //         'vnp_Locale' => 'vn',
    //         'vnp_OrderInfo' => 'Payment for Order #' . $order->id,
    //         "vnp_OrderType" => "other",
    //         'vnp_ReturnUrl' => $vnp_ReturnUrl,
    //         'vnp_TxnRef' => $order->id,
    //         "vnp_Bill_Mobile" => Auth::user()->phone,
    //         "vnp_Bill_Email" => Auth::user()->email,
    //         "vnp_Bill_FirstName" => Auth::user()->firstName,
    //         "vnp_Bill_LastName" => Auth::user()->lastName,
    //         "vnp_Bill_Address" => Auth::user()->address,
    //         "vnp_Bill_City" => Auth::user()->address,
    //         "vnp_Bill_Country" => "Viet Nam",
    //         "vnp_Inv_Phone" => "0969325914",
    //         "vnp_Inv_Email" => "namanhle02112003@gmail.com",
    //         "vnp_Inv_Customer" => "Lê Nam Anh",
    //         "vnp_Inv_Address" => "Mễ Trì, Nam Từ Liêm, Hà Nội",
    //         "vnp_Inv_Company" => "NahinnStore",
    //         "vnp_Inv_Taxcode" => "02112003",
    //         "vnp_Inv_Type" => "BillPayment"
    //     ];
    //     ksort($inputData);
    //     $query = "";
    //     $i = 0;
    //     $hashdata = "";
    //     foreach ($inputData as $key => $value) {
    //         if ($i == 1) {
    //             $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    //         } else {
    //             $hashdata .= urlencode($key) . "=" . urlencode($value);
    //             $i = 1;
    //         }
    //         $query .= urlencode($key) . "=" . urlencode($value) . '&';
    //     }

    //     $vnp_Url = $vnp_TestUrl . "?" . $query;
    //     if (isset($vnp_HashSecret)) {
    //         $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    //         $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
    //     }
    //     return redirect($vnp_Url);
    // }
    // public function returnPayment(Request $request)
    // {
    //     $vnpSecureHash = $request->get('vnp_SecureHash');
    //     $vnp_HashSecret = 'ZYCTQITJBJSIYKRGUROFFNJHNQGCRSPZ';
    //     $inputData = [];

    //     foreach ($request->all() as $key => $value) {
    //         if (strpos($key, 'vnp_') === 0) {
    //             $inputData[$key] = $value;
    //         }
    //     }

    //     unset($inputData['vnp_SecureHash']);

    //     ksort($inputData);

    //     $hashData = '';

    //     $i = 0;

    //     foreach ($inputData as $key => $value) {
    //         if ($i === 1) {
    //             $hashData .= '&' . urlencode($key) . '=' . urlencode($value);
    //         } else {
    //             $hashData .= urlencode($key) . '=' . urlencode($value);
    //             $i = 1;
    //         }
    //     }

    //     $calculatedSecureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);

    //     if ($vnpSecureHash === $calculatedSecureHash) {
    //         $order = Orders::find($inputData['vnp_TxnRef']);
    //         $order->status = 'COMPLETED';


    //         $orderDetails = OrderDetails::where('orderId', $inputData['vnp_TxnRef'])->get();
    //         foreach ($orderDetails as $orderDetail) {
    //             $productId = $orderDetail->productId;
    //             $quantity = $orderDetail->quantity;
    //             $sizeId = $orderDetail->sizeId;
    //             $colorId = $orderDetail->colorId;

    //             $attributeValueColor = AttributeValues::find($colorId)->first();
    //             $attributeValueSize = AttributeValues::find($sizeId)->first();

    //             $attributeValueColor->stock = $attributeValueColor->stock - $quantity;
    //             $attributeValueSize->stock = $attributeValueSize->stock - $quantity;

    //             $attributeValueColor->save();
    //             $attributeValueSize->save();
    //         }

    //         $orderId = $inputData['vnp_TxnRef'];
    //         $amount = $inputData['vnp_Amount'] / 100;
    //         $paymentContent = $inputData['vnp_OrderInfo'];
    //         $responseCode = $inputData['vnp_ResponseCode'];
    //         $transactionId = $inputData['vnp_TransactionNo'];
    //         $bankCode = $inputData['vnp_BankCode'];
    //         $paymentTime = $inputData['vnp_PayDate'];
    //         $paymentStatus = 'success';
    //     } else {
    //         $orderId = null;
    //         $amount = null;
    //         $paymentContent = null;
    //         $responseCode = null;
    //         $transactionId = null;
    //         $bankCode = null;
    //         $paymentTime = null;
    //         $paymentStatus = 'error';
    //     }

    //     return view('result', compact(
    //         'orderId',
    //         'amount',
    //         'paymentContent',
    //         'responseCode',
    //         'transactionId',
    //         'bankCode',
    //         'paymentTime',
    //         'paymentStatus'
    //     ));
    // }

    public function createMoney($orderId)
    {
        $order = Orders::find($orderId);
        $order->status = 'COMPLETED';

        $orderDetails = OrderDetails::where('orderId', $orderId)->get();
        foreach ($orderDetails as $orderDetail) {
            $quantity = $orderDetail->quantity;
            $sizeId = $orderDetail->sizeId;
            $colorId = $orderDetail->colorId;

            $attributeValueColor = AttributeValues::find($colorId)->first();
            $attributeValueSize = AttributeValues::find($sizeId)->first();

            $attributeValueColor->stock = $attributeValueColor->stock - $quantity;
            $attributeValueSize->stock = $attributeValueSize->stock - $quantity;

            $attributeValueColor->save();
            $attributeValueSize->save();
        }
        $order->save();
        $paymentStatus = 'success';
        return $this->success($paymentStatus);
    }

    public function success($paymentStatus){
        return view('share.result', compact('paymentStatus'));
    }
}
