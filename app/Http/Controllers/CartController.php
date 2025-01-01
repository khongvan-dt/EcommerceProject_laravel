<?php

namespace App\Http\Controllers;

use App\Models\AttributeValues;
use App\Models\Products;
use App\Models\Discounts;
use App\Models\Vouchers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function index()
{
    $cartData = request()->cookie('cartData');
    $cart = $cartData ? json_decode($cartData, true) : [];
    
    if (empty($cart)) {
        return view('share.cart', ['cartIndex' => []])->with('error', 'Your cart is empty.');
    }

    $products = Products::with([
        'media' => function ($query) {
            $query->where('mainImage', 1);
        },
    ])->whereIn('id', array_column($cart, 'productId'))->get();
    
    $colors = AttributeValues::whereIn('id', array_column($cart, 'colorId'))->get();
    $sizes = AttributeValues::whereIn('id', array_column($cart, 'sizeId'))->get();

    $discounts = Discounts::whereIn('productId', array_column($cart, 'productId'))
        ->where('status', 1)
        ->get();

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

     $voucherDiscount = 0;
    $grandTotal = $subTotal;
    $appliedVoucher = isset($cart['appliedVoucher']) ? $cart['appliedVoucher'] : null;

    if ($appliedVoucher) {
         $voucher = Vouchers::find($appliedVoucher['id']);
        if ($voucher && $voucher->status === 'ACTIVE') {
            $voucherDiscount = ($subTotal * $appliedVoucher['discountPercentage']) / 100;
            $grandTotal = $subTotal - $voucherDiscount;
        } else {
             unset($cart['appliedVoucher']);
            $cookie = cookie('cartData', json_encode($cart), 60 * 24 * 7);
            
             $response = response()->view('share.cart', compact('cartIndex', 'subTotal', 'grandTotal'));
            
             return $response->cookie($cookie);
        }
    }

    return view('share.cart', compact('cartIndex', 'subTotal', 'voucherDiscount', 'grandTotal', 'appliedVoucher'));
    }
    public function removeVoucher()
{
    try {
        // Lấy cart data từ cookie
        $cartData = json_decode(request()->cookie('cartData'), true) ?? [];
        
        // Kiểm tra xem có voucher đang áp dụng không
        if (!isset($cartData['appliedVoucher'])) {
            return response()->json([
                'success' => false,
                'message' => 'No voucher applied'
            ]);
        }

        // Xóa thông tin voucher khỏi cart
        unset($cartData['appliedVoucher']);

        // Tính lại tổng tiền
        $subTotal = $this->calculateSubTotal($cartData);

        // Tạo cookie mới với cart data đã cập nhật
        $cookie = cookie('cartData', json_encode($cartData), 60 * 24 * 7);

        return response()->json([
            'success' => true,
            'message' => 'Voucher removed successfully',
            'subTotal' => $subTotal,
            'grandTotal' => $subTotal // Vì đã xóa voucher nên grandTotal = subTotal
        ])->cookie($cookie);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error removing voucher'
        ]);
    }
}
    public function applyVoucher(Request $request) {
        $voucherCode = $request->input('voucher_code');
        
        // Lấy toàn bộ thông tin voucher thay vì chỉ lấy discountPercentage
        $voucher = Vouchers::where('code', $voucherCode)
            ->where('status', 'ACTIVE')
            ->where('quantity', '>', 0)
            ->first();
    
        if (!$voucher) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid voucher code or voucher is no longer available'
            ]);
        }
    
        $cartData = json_decode(request()->cookie('cartData'), true) ?? [];
        $subTotal = $this->calculateSubTotal($cartData);
    
        // Tính toán số tiền giảm giá và tổng tiền phải trả
        $discountAmount = ($subTotal * $voucher->discountPercentage) / 100;
        $grandTotal = $subTotal - $discountAmount;
    
        // Lưu thông tin voucher vào cart
        $cartData['appliedVoucher'] = [
            'id' => $voucher->id,
            'code' => $voucherCode,
            'discountPercentage' => $voucher->discountPercentage
        ];
    
        // Tạo cookie mới với thông tin đã cập nhật
        $cookie = cookie('cartData', json_encode($cartData), 60 * 24 * 7);
    
        if (!$voucher->decrementQuantity()) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating voucher quantity'
            ]);
        }
    
        return response()->json([
            'success' => true,
            'discount' => $discountAmount,
            'grandTotal' => $grandTotal,
            'discountPercentage' => $voucher->discountPercentage,
            'message' => "Voucher applied successfully - " . $voucher->discountPercentage . "% off"
        ])->cookie($cookie);
    }
    public function addToCart(Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'productId' => 'required|integer|exists:products,id',
            'sizeId' => 'required|integer|exists:attribute_values,id',
            'colorId' => 'required|integer|exists:attribute_values,id',
        ]);

        $quantity = $request->quantity;
        $productId = $request->productId;
        $sizeId = $request->sizeId;
        $colorId = $request->colorId;

        $cartData = [
            'productId' => $productId,
            'sizeId' => $sizeId,
            'colorId' => $colorId,
            'quantity' => $quantity
        ];

        $existingCartData = request()->cookie('cartData');
        $existingCart = $existingCartData ? json_decode($existingCartData, true) : [];

        $productExists = false;
        foreach ($existingCart as $key => $item) {
            if ($item['productId'] == $productId && $item['sizeId'] == $sizeId && $item['colorId'] == $colorId) {
                $existingCart[$key]['quantity'] += $quantity;
                $productExists = true;
                break;
            }
        }

        if (!$productExists) {
            $existingCart[] = $cartData;
        }

        $cookie = cookie('cartData', json_encode($existingCart), 4320);
        return response()->json(['message' => 'Product added to cart successfully'])->withCookie($cookie);
    }



    public function updateCart(Request $request)
{
    try {
       
        
        $quantities = $request->input('quantities');
        if(!$quantities) {
            throw new \Exception('No quantities provided');
        }

        $cart = json_decode(Cookie::get('cartData', '{"items":[]}'), true);

        foreach ($quantities as $productId => $quantity) {
            $quantity = (int)$quantity;
            
            if ($quantity <= 0) {
                continue;
            }

            foreach ($cart['items'] as &$item) {
                if ((int)$item['productId'] === (int)$productId) {
                    $item['quantity'] = $quantity;
                   
                }
            }
        }

       
        // Save updated cart
        Cookie::queue('cartData', json_encode($cart), 4320);

        return redirect()->route('cart')
            ->with('success', 'Cart updated successfully!');

    } catch (\Exception $e) {
         return redirect()->route('cart')
            ->with('error', 'Failed to update cart: ' . $e->getMessage());
    }
}

    public function deleteCart(Request $request)
    {
        $request->validate([
            'productId' => 'required|integer',
            'sizeId' => 'required|integer',
            'colorId' => 'required|integer',
        ]);

        $productId = $request->productId;
        $sizeId = $request->sizeId;
        $colorId = $request->colorId;

        $cart = json_decode(Cookie::get('cartData', '[]'), true);

        $updatedCart = array_filter($cart, function ($item) use ($productId, $sizeId, $colorId) {
            return !(
                isset($item['productId'], $item['sizeId'], $item['colorId']) &&
                $item['productId'] == $productId &&
                $item['sizeId'] == $sizeId &&
                $item['colorId'] == $colorId
            );
        });

        if (count($cart) === count($updatedCart)) {
            return redirect()->route('cart')->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng');
        }

        Cookie::queue('cartData', json_encode(array_values($updatedCart)), 4320);
        return redirect()->route('cart')->with('success', 'The product has been removed from the cart');
    }
}
