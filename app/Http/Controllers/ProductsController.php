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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::with('mainImage')
        ->where('status', 0)
        ->get();
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
        try {
            if ($request->hasFile('additionalImages')) {
                $currentImagesCount = ProductMedia::where('productId', $id)
                    ->where('mainImage', 0)
                    ->count();
                $newImagesCount = count($request->file('additionalImages'));
                
                if (($currentImagesCount + $newImagesCount) > 10) {
                    return redirect()
                        ->back()
                        ->withInput()
                        ->with('error', 'Total number of images cannot exceed 10. Current images: ' . $currentImagesCount);
                }
            }
    
            $validatedData = $request->validate([
                'name' => 'required|max:255',
                'description' => 'required',
                'slug' => $id ? "required|unique:products,slug,{$id}|max:255" : 'required|unique:products,slug|max:255',
                'brandId' => 'required|exists:brands,id',
                'categoryId' => 'required|exists:categories,id', 
                'typeId' => 'required|exists:types,id',
                'mainImage' => $id ? 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
                'additionalImages' => 'nullable|array|max:10',  
                'additionalImages.*' => 'nullable|image|mimes:webp,jpeg,png,jpg,gif|max:2048',
            ]);
    
            $storagePath = storage_path('app/public/products/images');
            if (!File::exists($storagePath)) {
                File::makeDirectory($storagePath, 0775, true);
            }
    
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
                    if(File::exists(public_path('storage/' . $currentMainImage->mediaUrl))) {
                        File::delete(public_path('storage/' . $currentMainImage->mediaUrl));
                    }
                    $currentMainImage->delete();
                }
    
                $mainImageFile = $request->file('mainImage');
                $mainImageName = time() . '_main_' . $mainImageFile->getClientOriginalName();
                $mainImageFile->move(public_path('storage/products/images'), $mainImageName);
                
                $productMedia = new ProductMedia();
                $productMedia->productId = $product->id;
                $productMedia->mediaUrl = 'products/images/' . $mainImageName;
                $productMedia->mediaType = 'image';
                $productMedia->mainImage = 1;
                $productMedia->save();
            }
 
if ($request->hasFile('additionalImages')) {
     foreach ($request->file('additionalImages') as $image) {
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('storage/products/images'), $imageName);
        
        $additionalMedia = new ProductMedia();
        $additionalMedia->productId = $product->id;
        $additionalMedia->mediaUrl = 'products/images/' . $imageName;
        $additionalMedia->mediaType = 'image';
        $additionalMedia->mainImage = 0;
        $additionalMedia->save();
    }
}
    
            $message = $id ? 'Product updated successfully.' : 'Product created successfully.';
            return redirect()->route('admin.products.index')->with('success', $message);
    
        } catch (\Exception $e) {
             return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Error saving product: ' . $e->getMessage());
        }
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
    public function destroy($id)
    {
        $product = Products::find($id);
        $product->status = 1;
        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

}
