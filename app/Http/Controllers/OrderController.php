<?php

namespace App\Http\Controllers;

use App\Models\OrderDetails;
use App\Models\Orders;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Orders::with([
            'user'
        ])->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id){
        $order = Orders::find($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, $id){
        $validateData = $request->validate([
            'totalPrice' => 'nullable|numeric',
            'paymentMethod' => 'nullable|in: VNPay, paymoney',
            'status' => 'required|in:PENDING, COMPLETED, CANCELED'
        ]);

        $order = Orders::find($id);
        $order->update($validateData);

        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    public function show($id){
        $orderDetails = OrderDetails::with([
            'product', 
            'media',  
            'size',      
            'color'    
        ])
            ->where('orderId', $id)
            ->get();
        return view('admin.orderDetails.index', compact('orderDetails'));
    }
}
