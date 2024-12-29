<?php

namespace App\Http\Controllers;

use App\Models\Discounts;
use App\Models\Products;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discounts::all();
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create()
    {
        $products = Products::all();
        return view('admin.discounts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'productId' => 'required|exists:products,id',
            'discountPercentage' => 'required|numeric|min:0|max:100',
            'startDate' => 'required|date|before:endDate',
            'endDate' => 'required|date|after:startDate',
        ]);

        Discounts::create($validatedData);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount created successfully');
    }

    public function edit($id){
        $discount = Discounts::find($id);
        $products = Products::all();
        return view('admin.discounts.edit', compact('discount', 'products'));
    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'productId' => 'required|exists:products,id',
            'discountPercentage' => 'required|numeric|min:0|max:100',
            'startDate' => 'required|date|before:endDate',
            'endDate' => 'required|date|after:startDate',
        ]);

        $discount = Discounts::find($id);
        $discount->update($validatedData);

        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated successfully');
    
        }

    public function destroy($id){
        Discounts::find($id)->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted successfully');
    }
}
