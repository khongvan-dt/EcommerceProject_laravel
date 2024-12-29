<?php

namespace App\Http\Controllers;

use App\Models\Attributes;
use App\Models\ProductAtrribute;
use App\Models\ProductAttribute;
use App\Models\Products;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index($id)
    {
        $attributes = Attributes::select('attributes.*') 
            ->leftJoin('product_attribute', 'attributes.id', '=', 'product_attribute.attributeId')
            ->where('product_attribute.productId', $id)
            ->get();
        $product = Products::select()->where('id', '=', $id)->first();
        return view('admin.attributes.index', compact('attributes', 'product'));
    }

    public function create($id)
    {
        $productId = $id;
        return view('admin.attributes.create', compact('productId'));
    }

    public function store(Request $request, $id)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $productId = $id;

        $attribute = new Attributes();
        $attribute->name = $validateData['name'];
        $attribute->save();

        $productAttribute = new ProductAttribute();
        $productAttribute->productId = $id;
        $productAttribute->attributeId = $attribute->id;
        $productAttribute->save();

        return redirect()->route('admin.attributes.index', ['id' => $productId])->with('success', 'Attribute created successfully.');
    }

    public function edit($id, $productId)
    {
        $attribute = Attributes::find($id);
        return view('admin.attributes.edit', compact('attribute', 'productId'));
    }

    public function update(Request $request, $id, $productId)
    {
        $validateData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $attribute = Attributes::find($id);
        $attribute->update($validateData);

        return redirect()->route('admin.attributes.index', ['id' => $productId])->with('success', 'Attribute updated successfully.');
    }

    public function destroy($id, $productId)
    {
        $attribute = Attributes::find($id);
        $attribute->status = 1;
        $attribute->update();

        return redirect()->route('admin.attributes.index', ['id' => $productId])->with('success', 'Attribute deleted successfully.');
    }
}
