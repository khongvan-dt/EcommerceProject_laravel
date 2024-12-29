<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Categories;
use App\Models\ProductAtrribute;
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'slug' => 'required|unique:products,slug|max:255',
            'brandId' => 'required|exists:brands,id',
            'categoryId' => 'required|exists:categories,id',
            'typeId' => 'required|exists:types,id',
            'mainImage' => 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'additionalImages.*' => 'image|mimes:webp,jpeg,png,jpg,gif|max:2048',
        ]);

        // Tạo sản phẩm
        $product = new Products();
        $product->name = $validatedData['name'];
        $product->description = $validatedData['description'];
        $product->slug = $validatedData['slug'];
        $product->brandId = $validatedData['brandId'];
        $product->save();

        // Tạo liên kết danh mục
        $productCategory = new ProductCategory();
        $productCategory->categoryId = $validatedData['categoryId'];
        $productCategory->productId = $product->id;
        $productCategory->save();

        // Tạo liên kết loại sản phẩm
        $productType = new ProductTypes();
        $productType->typeId = $validatedData['typeId'];
        $productType->productId = $product->id;
        $productType->save();

        $productMedia = new ProductMedia();
        $productMedia->productId = $product->id;
        $productMedia->mediaUrl = $request->file('mainImage')->store('products/images', 'public');
        $productMedia->mediaType = 'image';
        $productMedia->mainImage = 1;
        $productMedia->save();

        if ($request->hasFile('additionalImages')) {
            foreach ($request->file('additionalImages') as $image) {
                $additionalMedia = new ProductMedia();
                $additionalMedia->productId = $product->id;
                $additionalMedia->mediaUrl = $image->store('products/images', 'public');
                $additionalMedia->mediaType = 'image';
                $additionalMedia->mainImage = 0;
                $additionalMedia->save();
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }


    public function edit($id)
    {
        $product = Products::find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'slug' => "required|unique:products,slug,{$id}|max:255",
            'brandId' => 'required|exists:brands,id',
            'categoryId' => 'required|exists:categories,id',
            'typeId' => 'required|exists:types,id',
            'mainImage' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            'additionalImages.*' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Products::findOrFail($id);
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
            $currentMainImage = ProductMedia::where('productId', $product->id)->where('mediaType', 'image')->first();
            if ($currentMainImage) {
                Storage::disk('public')->delete($currentMainImage->mediaUrl);
                $currentMainImage->delete();
            }

            $mainImageMedia = new ProductMedia();
            $mainImageMedia->productId = $product->id;
            $mainImageMedia->mediaUrl = $request->file('mainImage')->store('products/image', 'public');
            $mainImageMedia->mediaType = 'image';
            $mainImageMedia->save();
        }

        if ($request->hasFile('additionalImages')) {
            ProductMedia::where('productId', $product->id)->where('mediaType', 'image')->delete();

            foreach ($request->file('additionalImages') as $image) {
                $additionalMedia = new ProductMedia();
                $additionalMedia->productId = $product->id;
                $additionalMedia->mediaUrl = $image->store('products/image', 'public');
                $additionalMedia->mediaType = 'image';
                $additionalMedia->save();
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }


    public function destroy($id)
    {
        $product = Products::find($id);
        $product->status = 1;
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
