<?php
// app/Http/Controllers/OrderHistoryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderHistoryController extends Controller
{
    public function userOrderHistory($userId)
    {
        $orders = Order::with('orderItems.product')
            ->where('user_id', $userId)
            ->latest()->get();

        return view('users.order_history', compact('orders'));
    }

    public function adminOrderHistory()
    {
        $orders = Order::with('orderItems.product')->latest()->get();

        return view('admin.order_history', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $request->validate([
            'order_status' => 'required|string|in:pending,dikirim,telah sampai,selesai',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->order_status;
        $order->save();

        return redirect()->route('admin.order_history')->with('success', 'Order status updated successfully.');
    }
}
