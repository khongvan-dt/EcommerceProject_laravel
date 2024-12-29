<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('brands', 'public');
            $validatedData['logo'] = $logoPath;
        }

        $brand = new Brands();
        $brand->name = $validateData['name'];
        $brand->logo = $validatedData['logo'];
        $brand->slug = $validateData['slug'];
        $brand->description = $validateData['description'];
        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand added successfully.');
    }

    public function edit($id)
    {
        $brand = Brands::find($id);
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'logo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'description' => 'nullable',
            'slug' => ['required', 'max:255', Rule::unique('brands')->ignore($id)],
        ]);

        $brand = Brands::find($id);

        $brand->name = $validateData['name'];
        $brand->description = $validateData['description'];
        $brand->slug = $validateData['slug'];

        if ($request->hasFile('logo')) {
            if ($brand->logo && Storage::exists($brand->logo)) {
                Storage::delete($brand->logo);
            }

            $logoPath = $request->file('logo')->store('brands', 'public');
            $brand->logo = $logoPath;
        }

        $brand->save();

        return redirect()->route('admin.brands.index')->with('success', 'Brand updated successfully.');
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
