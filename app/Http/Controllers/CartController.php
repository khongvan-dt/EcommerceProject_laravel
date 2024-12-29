<?php

namespace App\Http\Controllers;

use App\Models\AttributeValues;
use App\Models\Products;
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
        $cartIndex = [];

        $subTotal = 0;

        foreach ($cart as $cartItem) {
            $product = $products->firstWhere('id', $cartItem['productId']);
            $color = $colors->firstWhere('id', $cartItem['colorId']);
            $size = $sizes->firstWhere('id', $cartItem['sizeId']);

            if (!$product || !$color || !$size) {
                continue; // Bỏ qua sản phẩm không tồn tại
            }

            $subTotal += ($color->priceOut + $size->priceOut) / 2 * $cartItem['quantity'];
            $cartIndex[] = [
                'product' => $product,
                'color' => $color,
                'size' => $size,
                'price' => ($color->priceOut + $size->priceOut) / 2,
                'quantity' => $cartItem['quantity'],
            ];
        }

        return view('share.cart', compact('cartIndex', 'subTotal'));
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
        return redirect()->route('cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng');
    }
}
