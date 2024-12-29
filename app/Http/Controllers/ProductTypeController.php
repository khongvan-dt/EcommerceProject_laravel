<?php

namespace App\Http\Controllers;

use App\Models\ProductTypes;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function index(){
        $productTypes = ProductTypes::all();
        return view('admin.product_type.index', compact('productTypes'));
    }

    public function create(){
        return view('admin.productTypes.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'productId' => 'required|exists:products,id',
            'name' => 'required|max:255',
        ]);

        ProductTypes::create($validateData);

        return redirect()->route('admin.productTypes.index')->with('success', 'Product Type Created Successfully');
    }

    public function edit($id){
        $productType = ProductTypes::find($id);
        return view('admin.productTypes.edit', compact('productType'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'productId' => 'required|exists:products,id',
            'name' => 'required|max:255',
        ]);

        $productType = ProductTypes::find($id);
        $productType->update($validateData);
        return redirect()->route('admin.productTypes.index')->with('success', 'Product Type Updated Successfully');
    }

    public function destroy($id){
        $productType = ProductTypes::find($id);
        $productType->status = 1;
        $productType->save();
        return redirect()->route('admin.productTypes.index')->with('success', 'Product Type Deleted Successfully');
    }
}
