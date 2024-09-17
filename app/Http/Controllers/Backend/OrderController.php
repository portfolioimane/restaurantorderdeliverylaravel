<?php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Eager load relationships to avoid the N+1 problem
        $orders = Order::with([
            'customer', 
            'items.food', 
            'driver'
        ])->get();
        
        $drivers = User::where('role', 'driver')->get();
        
        return view('admin.orders.index', compact('orders', 'drivers'));
    }

   public function show($id)
{
    $order = Order::with('items.food', 'customer')->findOrFail($id);
    return view('admin.orders.show', compact('order'));
}


    public function assignDriver(Request $request, Order $order)
    {
        $request->validate([
            'driver_id' => 'required|exists:users,id',
        ]);

        $order->driver_id = $request->driver_id;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Driver assigned successfully.');
    }


    // OrderController.php

public function updateStatus(Request $request, $id)
{
    $order = Order::findOrFail($id);

    $request->validate([
        'status' => 'required|string|in:pending,progress,completed,received,ongoing,delivered',
    ]);

    $order->status = $request->input('status');
    $order->save();

    return redirect()->back()->with('success', 'Order status updated successfully.');
}


}
