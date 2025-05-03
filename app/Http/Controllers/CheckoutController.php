<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Cart;
use App\Models\OrderHistory;
use App\Services\MidtransService;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    protected $midtrans;

    public function __construct(MidtransService $midtrans)
    {
        $this->midtrans = $midtrans;
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        // Ambil order_id dari session jika ada
        $order = null;
        if ($request->session()->has('order_id')) {
            $order = Order::find($request->session()->get('order_id'));
        }

        return view('checkout.index', compact('user', 'cart', 'order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        $user = Auth::user();
        $cart = $user->cart;

        if (!$cart || $cart->cartItems->count() == 0) {
            return redirect()->route('home')->with('error', 'Your cart is empty.');
        }

        $totalAmount = $cart->cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        $order = new Order([
            'user_id' => $user->id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'total' => $totalAmount,
            'status' => 'pending',
        ]);

        $order->save();
        
        

        foreach ($cart->cartItems as $cartItem) {
            $orderItem = new OrderItem([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
            $orderItem->save();
            
            OrderHistory::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'total_price' => $cartItem->product->price * $cartItem->quantity,
                'order_status' => 'pending',
            ]);

            $cartItem->product->reduceStock($cartItem->quantity);
        }

        $cart->cartItems()->delete();

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => (int)$totalAmount, // Ensure the amount is an integer
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
            ]
        ];

        // Log::info('Midtrans parameters: ' . json_encode($params));

        // try {
        //     $snapTransaction = $this->midtrans->createTransaction($params);
        //     $snapToken = $snapTransaction->token;
        //     Log::info('Midtrans Snap Token: ' . $snapToken);

        //     // Simpan order_id dalam session
        //     $request->session()->put('order_id', $order->id);
        // } catch (\Exception $e) {
        //     return redirect()->route('checkout.index')->with('error', 'Payment failed: ' . $e->getMessage());
        // }

        // return view('checkout.payment', compact('snapToken', 'order'));
        return view('checkout.payment');
    }
}
