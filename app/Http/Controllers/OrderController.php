<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function getAll()
    {
        try {
            $orders = Order::with(['products.categories', 'user'])->get();
            return response($orders);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }

    public function getForUserId($id)
    {
        try {
            $orders = Order::where('user_id', $id);
            return response($orders->load('products'));;
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }

    public function insert(Request $request)
    {
        try {
            $body = $request->validate([
                'deliveryDate' => 'required|date',
                'products' => 'required|array'
            ]);
            $body['status'] = 'pending';
            $body['user_id'] = Auth::id();
            $products = $body['products'];
            unset($body['products']);
            $order = Order::create($body);
            $order->products()->attach($products);
            $order = $order->load('user', 'products');
            return response($order, 201);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $body = $request->validate([
                'status' => 'string',
                'products' => 'array'
            ]);
            $order = Order::find($id);
            if ($request->has('products')) {
                $products = $body['products'];
                unset($body['products']);
                $order->update($body);
                $order->products()->sync($products);
            } else {
                $order->update($body);
            }
            return response($order->load('user', 'products'), 201);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }
}
