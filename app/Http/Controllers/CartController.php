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

        $voucherCode = session('voucher');
        $voucher = Vouchers::where('code', $voucherCode)->first();
        $total = $subTotal;
        if ($voucher) {
            $subTotal = $subTotal - ($subTotal * $voucher->discountPercentage / 100);
        }
        
        return view('share.cart', compact('cartIndex', 'subTotal', 'total'));
    }
    
    public function applyVoucher(Request $request) 
    {
        $voucherCode = $request->input('voucherCode');
        
        $voucher = Vouchers::where('code', $voucherCode)
            ->where('status', 'ACTIVE')
            ->where('quantity', '>', 0)
            ->first();

        if (!$voucher) {
            return back()->with('voucherError', 'Voucher không hợp lệ');
        }

        session(['voucher' => $voucherCode]);

        return redirect()->route('cart');
    }
    public function removeVoucher(Request $request)
    {
        $request->session()->forget('voucher');

        return redirect()->route('cart')->with('success', 'Voucher has been removed successfully.');
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
            // Lấy danh sách số lượng từ request
            $quantities = $request->input('quantities');
    
            if (!$quantities || !is_array($quantities)) {
                throw new \Exception('No quantities provided or invalid format.');
            }
    
            // Lấy dữ liệu giỏ hàng từ cookie
            $cart = json_decode(Cookie::get('cartData', '[]'), true);
    
            // Đảm bảo giỏ hàng có định dạng phù hợp
            if (!is_array($cart)) {
                $cart = [];
            }
    
            // Duyệt qua danh sách số lượng cập nhật
            foreach ($cart as &$item) {
                $productId = $item['productId'];
                if (array_key_exists($productId, $quantities)) {
                    $quantity = (int)$quantities[$productId];
    
                    // Kiểm tra số lượng hợp lệ
                    if ($quantity > 0) {
                        $item['quantity'] = $quantity;
                    } else {
                        // Nếu số lượng <= 0, xóa sản phẩm khỏi giỏ hàng
                        $item = null;
                    }
                }
            }
    
            $cart = array_filter($cart);
    
            Cookie::queue('cartData', json_encode(array_values($cart)), 4320);
    
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
