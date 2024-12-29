<?php

namespace App\Http\Controllers;

use App\Models\Vouchers;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function index(){
        $vouchers = Vouchers::all();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create(){
        return view('admin.vouchers.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'code' => 'required|max:255',  
            'discountPercentage' => 'required|numeric|min:0|max:100', 
            'minPurchaseAmount' => 'required|numeric|min:0', 
            'quantity' => 'required|integer|min:1', 
            'startDate' => 'required|date|before:endDate',  
            'endDate' => 'required|date|after:startDate', 
        ]);        

        Vouchers::create($validateData);
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher created successfully');
    }

    public function edit($id){
        $voucher = Vouchers::find($id);
        return view('admin.vouchers.edit', compact('voucher'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'code' => 'required|max:255',  
            'discountPercentage' => 'required|numeric|min:0|max:100', 
            'minPurchaseAmount' => 'required|numeric|min:0', 
            'quantity' => 'required|integer|min:1', 
            'startDate' => 'required|date|before:endDate',  
            'endDate' => 'required|date|after:startDate',
        ]);

        $voucher = Vouchers::find($id);
        if ($voucher->status == 'INACTIVE') {
            $voucher->status = 'ACTIVE';
            $voucher->save();
        }
        $voucher->update($validateData);
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher updated successfully');
    }

    public function destroy($id){
        $voucher = Vouchers::find($id);
        $voucher->status = 'INACTIVE';
        $voucher->save();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher deleted successfully');
    }
}
