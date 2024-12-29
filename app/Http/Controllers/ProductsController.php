<?php
namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\ProductCategory;
use App\Models\ProductMedia;
use App\Models\Products;
use App\Models\ProductTypes;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with('mainImage')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $brands = Brands::all();
        $categories = Categories::all();
        $types = Types::all();
        return view('admin.products.create', compact('brands', 'categories', 'types'));
    }
    public function store(Request $request, $id = null) 
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'slug' => $id ? "required|unique:products,slug,{$id}|max:255" : 'required|unique:products,slug|max:255',
            'brandId' => 'required|exists:brands,id',
            'categoryId' => 'required|exists:categories,id',
            'typeId' => 'required|exists:types,id',
            'mainImage' => $id ? 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'additionalImages.*' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Products::findOrNew($id);
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->slug = $validatedData['slug'];
        $product->brandId = $validatedData['brandId'];
        $product->save();

        ProductCategory::updateOrCreate(
            ['productId' => $product->id],
            ['categoryId' => $validatedData['categoryId']]
        );
        ProductTypes::updateOrCreate(
            ['productId' => $product->id],
            ['typeId' => $validatedData['typeId']]
        );

        if ($request->hasFile('mainImage')) {
            $currentMainImage = ProductMedia::where('productId', $product->id)
                ->where('mainImage', 1)
                ->first();
            
            if ($currentMainImage) {
                Storage::disk('public')->delete($currentMainImage->mediaUrl);
                $currentMainImage->delete();
            }

            $productMedia = new ProductMedia();
            $productMedia->productId = $product->id;
            $productMedia->mediaUrl = $request->file('mainImage')->store('products/images', 'public');
            $productMedia->mediaType = 'image';
            $productMedia->mainImage = 1;
            $productMedia->save();
        }
        if ($request->hasFile('additionalImages')) {
            if ($id) {
                ProductMedia::where('productId', $product->id)
                    ->where('mainImage', 0)
                    ->get()
                    ->each(function($media) {
                        Storage::disk('public')->delete($media->mediaUrl);
                        $media->delete();
                    });
            }
            foreach ($request->file('additionalImages') as $image) {
                $additionalMedia = new ProductMedia();
                $additionalMedia->productId = $product->id;
                $additionalMedia->mediaUrl = $image->store('products/images', 'public');
                $additionalMedia->mediaType = 'image';
                $additionalMedia->mainImage = 0;
                $additionalMedia->save();
            }
        }
        $message = $id ? 'Product updated successfully.' : 'Product created successfully.';
        return redirect()->route('admin.products.index')->with('success', $message);
    }

    public function edit($id)
    {
        $product = Products::with([
            'productCategory',
            'productType',
            'productMedia',
            'mainImage'
        ])->findOrFail($id);
        $brands = Brands::all();
        $categories = Categories::all();
        $types = Types::all();
        return view('admin.products.edit', compact('product', 'brands', 'categories', 'types'));
    }
}
