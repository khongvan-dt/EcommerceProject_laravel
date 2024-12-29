<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Products;
use App\Models\ProductTypes;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardUserController extends Controller
{
    public function index(Request $request)
    {
        $types = Types::all();

        if ($request->has('type') && $request->type != '') {
            $productsByType = Products::whereHas('types', function ($query) use ($request) {
                $query->where('typeId', $request->type);
            })
                ->with(['media' => function ($query) {
                    $query->where('mainImage', 1);
                }])
                ->get();
        } else {
            $productsByType = Products::with(['media' => function ($query) {
                $query->where('mainImage', 1);
            }])->get();
        }

        return view('share.dashboard', compact('types', 'productsByType'));
    }

    public function shop(Request $request)
    {
        $categories = Categories::withCount('products')->get();
        $brands = Brands::withCount('products')->get();

        $query = Products::with([
            'media' => function ($query) {
                $query->where('mainImage', 1);
            },
            'attributeValues' => function ($query) {
                $query->select('productId', 'priceOut');
            }
        ]);

        if ($request->has('category') && $request->category != '') {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('categoryId', $request->category);
            });
        }

        if ($request->has('brand') && $request->brand != '') {
            $query->where('brandId', $request->brand);
        }

        if ($request->has('price_range') && $request->price_range != '') {
            if (strpos($request->price_range, '-') !== false) {
                [$minPrice, $maxPrice] = explode('-', $request->price_range);
            } else {
                $minPrice = $request->price_range;
                $maxPrice = PHP_INT_MAX;
            }

            $query->whereHas('attributes', function ($subQuery) use ($minPrice, $maxPrice) {
                $subQuery->whereHas('attributeValues', function ($valueQuery) use ($minPrice, $maxPrice) {
                    $valueQuery->whereBetween('priceOut', [(float)$minPrice / 1000, (float)$maxPrice / 1000]);
                });
            });
        }

        if ($request->has('color') && $request->color != '') {
            $query->whereHas('attributes', function ($subQuery) use ($request) {
                $subQuery->where('name', 'color')
                    ->whereHas('attributeValues', function ($valueQuery) use ($request) {
                        $valueQuery->where('value', $request->color);
                    });
            });
        }

        if ($request->has('size') && $request->size != '') {
            $query->whereHas('attributes', function ($subQuery) use ($request) {
                $subQuery->where('name', 'size')
                    ->whereHas('attributeValues', function ($valueQuery) use ($request) {
                        $valueQuery->where('value', $request->size);
                    });
            });
        }

        $products = $query->paginate(9);
        return view('share.shop', [
            'categories' => $categories,
            'brands' => $brands,
            'products' => $products,
            'total_products' => $products->total(),
            'total_pages' => $products->lastPage(),
            'current_page' => $products->currentPage(),
        ]);
    }

    public function product($id)
    {
        $product = Products::with([
            'categories',
            'brand',
            'media',
            'attributes' => function ($query) {
                $query->select('attributes.id', 'attributes.name');
            },
            'attributeValues' => function ($query) {
                $query->select('attribute_values.id', 'attribute_values.name', 'attribute_values.priceOut', 'attribute_values.stock', 'attribute_values.attributeId');
            },
        ])
            ->where('id', $id)
            ->firstOrFail();
        $relatedProducts = Products::with([
            'media' => function ($query) {
                $query->where('mainImage', 1);
            },
            'attributeValues' => function ($query) {
                $query->select('attribute_values.id', 'attribute_values.name', 'attribute_values.priceOut', 'attribute_values.stock', 'attribute_values.attributeId');
            }
        ])
            ->where('brandId', $product->brandId);
        return view('share.product', compact('product', 'relatedProducts'));
    }

    public function listOrder()
    {
        $orders = Orders::where('userId', '=', Auth::user()->id)->get();
        return view('share.listOrder', compact('orders'));
    }

    public function listOrderDetail($orderId)
    {
        $orderDetails = OrderDetails::with([
            'product', 
            'media',  
            'size',      
            'color'    
        ])
            ->where('orderId', $orderId)
            ->get();
        return view('share.listOrderDetail', compact('orderDetails'));
    }

    public function contact(){
        return view('share.contact');
    }

    public function blog(){
        return view('share.blog');
    }

    public function about(){
        return view('share.about');
    }
}
