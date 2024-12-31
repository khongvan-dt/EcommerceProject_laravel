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
    // public function index()
    // {
    //     $cartData = request()->cookie('cartData');
    //     $cart = $cartData ? json_decode($cartData, true) : [];
        
    //     if (empty($cart)) {
    //         return view('share.cart', ['cartIndex' => []])->with('error', 'Your cart is empty.');
    //     }

    //     $products = Products::with([
    //         'media' => function ($query) {
    //             $query->where('mainImage', 1);
    //         },
    //     ])->whereIn('id', array_column($cart, 'productId'))->get();
        
    //     $colors = AttributeValues::whereIn('id', array_column($cart, 'colorId'))->get();
    //     $sizes = AttributeValues::whereIn('id', array_column($cart, 'sizeId'))->get();

    //     $discounts = Discounts::whereIn('productId', array_column($cart, 'productId'))
    //         ->where('status', 1)
    //         ->get();

    //     $cartIndex = [];
    //     $subTotal = 0;

    //     foreach ($cart as $cartItem) {
    //         $product = $products->firstWhere('id', $cartItem['productId']);
    //         $color = $colors->firstWhere('id', $cartItem['colorId']);
    //         $size = $sizes->firstWhere('id', $cartItem['sizeId']);

    //         if (!$product || !$color || !$size) {
    //             continue;
    //         }

    //         $price = ($color->priceOut + $size->priceOut) / 2;

    //         $activeDiscount = $discounts->firstWhere('productId', $cartItem['productId']);
            
    //         if ($activeDiscount) {
    //             $price = $price - ($price * $activeDiscount->discountPercentage / 100);
    //         }

    //         $itemTotal = $price * $cartItem['quantity'];
    //         $subTotal += $itemTotal;

    //         $cartIndex[] = [
    //             'product' => $product,
    //             'color' => $color,
    //             'size' => $size,
    //             'price' => $price,
    //             'quantity' => $cartItem['quantity'],
    //         ];
    //     }

    //     return view('share.cart', compact('cartIndex', 'subTotal'));
    // }

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
    
        // Fetch active discounts
        $discounts = Discounts::whereIn('productId', array_column($cart, 'productId'))
            ->where('status', 1)
            ->get();
    
        $cartIndex = [];
        $subTotal = 0;
    
        foreach ($cart as $cartItem) {
            $product = $products->firstWhere('id', $cartItem['productId']);
            $color = $colors->firstWhere('id', $cartItem['colorId']);
            $size = $sizes->firstWhere('id', $cartItem['sizeId']);
    
            if (!$product || !$color || !$size) {
                continue;
            }
    
            // Calculate original price
            $price = ($color->priceOut + $size->priceOut) / 2;
    
            // Check for active discount
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
    
        $voucherCode = request()->input('voucher_code');
        $voucherDiscount = 0;
        $grandTotal = $subTotal;
        $voucherData = session('voucher_data');

    
        if ($voucherCode) {
            $voucher = Vouchers::where('code', 'LIKE', $voucherCode)
                ->where('status', 'ACTIVE')
                ->first();
    
            if ($voucher) {
                 if (!$voucher->minPurchaseAmount || $subTotal >= $voucher->minPurchaseAmount) {
                    $voucherDiscount = ($subTotal * $voucher->discountPercentage) / 100;
                    $grandTotal = $subTotal - $voucherDiscount;
                }
            }
        }
    
   

    return view('share.cart', compact(
        'cartIndex', 
        'subTotal', 
        'voucherDiscount', 
        'grandTotal', 
        'voucherData'
    ));
    }
    
    public function applyVoucher(Request $request)
{
    $voucherCode = $request->input('voucher_code');
    
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

    $cartData = json_decode(request()->cookie('cartData'), true);
    $subTotal = $this->calculateSubTotal($cartData);

    if ($voucher->minPurchaseAmount && $subTotal < $voucher->minPurchaseAmount) {
        return response()->json([
            'success' => false,
            'message' => 'Minimum purchase amount not met'
        ]);
    }

     session([
        'applied_voucher' => [
            'code' => $voucherCode,
            'id' => $voucher->id,
            'discount_percentage' => $voucher->discountPercentage,
            'applied_at' => now()
        ]
    ]);

    $discount = ($subTotal * $voucher->discountPercentage) / 100;
    $grandTotal = $subTotal - $discount;

    // Only decrement quantity after successful application
    if (!$voucher->decrementQuantity()) {
        return response()->json([
            'success' => false,
            'message' => 'Error updating voucher quantity'
        ]);
    }

    return response()->json([
        'success' => true,
        'discount' => $discount,
        'grandTotal' => $grandTotal,
        'voucher_id' => $voucher->id,
        'message' => 'Voucher applied successfully'
    ]);
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
        $quantities = $request->input('quantities');
        $cart = json_decode(Cookie::get('cartData', '[]'), true);

        foreach ($quantities as $productId => $quantity) {
            if ($quantity <= 0) {
                continue;
            }

            foreach ($cart as &$item) {
                if ($item['productId'] == $productId) {
                    $item['quantity'] = $quantity;
                }
            }
        }

        Cookie::queue('cartData', json_encode($cart), 4320);

        return redirect()->route('cart')->with('success', 'Cart updated successfully!');
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
