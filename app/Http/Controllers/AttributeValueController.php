<?php

namespace App\Http\Controllers;

use App\Models\AttributeValues;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function index($id){
        $attributeValues = AttributeValues::where('attributeId', '=', $id)->get();
        $attributeId = $id;
        return view('admin.attribute_values.index', compact('attributeValues', 'attributeId'));
    }

    public function create($id){
        $attributeId = $id;
        return view('admin.attribute_values.create', compact('attributeId'));
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'attributeId' => 'required|exists:attributes,id',
            'name' => 'required|max:255',
            'stock' => 'required|integer|min:0', 
            'priceIn' => 'required|min:0',
            'priceOut' => 'required|min:0',
        ]);
        
        AttributeValues::create($validateData);
        return redirect()->route('admin.attributeValues.index', ['id' => $request->attributeId])->with('success', 'Attribute Value created successfully');
    }

    public function edit($id, $attributeId){
        $attributeValue = AttributeValues::find($id);
        return view('admin.attribute_values.edit', compact('attributeValue', 'attributeId'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'attributeId' => 'required|exists:attributes,id',
            'name' => 'required|max:255',
            'stock' => 'required|integer|min:0', 
            'priceIn' => 'required|numeric|min:0',
            'priceOut' => 'required|numeric|min:0',
        ]);
        
        AttributeValues::find($id)->update($validateData);
        return redirect()->route('admin.attributeValues.index',['id' => $validateData['attributeId']])->with('success', 'Attribute Value updated successfully');
    
    }

    public function destroy($id, $attributeId){
        AttributeValues::destroy($id);
        return redirect()->route('admin.attributeValues.index',['id' => $attributeId])->with('success', 'Attribute Value deleted successfully');
    }

    public function updateStatus($id){
        $attributeValue = AttributeValues::find($id);
        $attributeValue->status = 1;
        $attributeValue->save();
        return redirect()->route('admin.attributeValues.index')->with('success', 'Status updated successfully');
    }
}
