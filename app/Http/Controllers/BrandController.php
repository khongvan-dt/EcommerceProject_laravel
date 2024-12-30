<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
 class BrandController extends Controller
{
    public function index()
    {
        $brands = Brands::where('status', '=', '0')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'logo' => 'nullable|image|mimes:webp,jpg,png,jpeg|max:2048',
            'slug' => 'required|max:255|unique:brands,slug',
            'description' => 'nullable',
        ]);
    
         $storagePath = storage_path('app/public/brands');
        if (!File::exists($storagePath)) {
            File::makeDirectory($storagePath, 0775, true);
        }
    
        $brand = new Brands();
        $brand->name = $validateData['name'];
        $brand->slug = $validateData['slug'];
        $brand->description = $validateData['description'];
    
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = $logo->getClientOriginalName();
            
             $logo->move(public_path('storage/brands'), $logoName);
            $brand->logo = 'brands/' . $logoName;
        }
    
        $brand->save();
        return redirect()->route('admin.brands.index')->with('success', 'Brand added successfully.');
    }
    
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable',
            'slug' => ['required', 'max:255', Rule::unique('brands')->ignore($id)],
        ]);
    
        $brand = Brands::findOrFail($id);
        $brand->name = $validateData['name'];
        $brand->description = $validateData['description'];
        $brand->slug = $validateData['slug'];
    
        if ($request->hasFile('logo')) {
             if ($brand->logo && File::exists(public_path('storage/' . $brand->logo))) {
                File::delete(public_path('storage/' . $brand->logo));
            }
    
            $logo = $request->file('logo');
            $logoName = $logo->getClientOriginalName();
            
             $logo->move(public_path('storage/brands'), $logoName);
            $brand->logo = 'brands/' . $logoName;
        }
    
        $brand->save();
        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
    }

    public function edit($id)
    {
        $brand = Brands::find($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function destroy($id)
    {
        $brand = Brands::find($id);
        Storage::delete($brand->logo);
        $brand->status = 1;
        $brand->update();

        return redirect()->route('admin.brands.index')->with('success', 'Brand deleted successfully.');
    }
}
