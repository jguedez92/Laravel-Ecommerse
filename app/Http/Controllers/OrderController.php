<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Product;
use App\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function getAll()
    {
        try {
            $orders = Order::get();
            return response($orders->load('product.user', 'user'));
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }

    public function getForUser()
    {
        try {
            $id = Auth::id();
            $orders = Order::where('user_id', $id);
            return response($orders->load('products'));;
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }

    public function insert(Request $request)
    {
        try {
            $data = $request->validate([
                'product_id' => 'required|integer',
                'renting_days' => 'required|integer',
                'price_total_renting' => 'required|numeric',
            ]);
            $body['user_id'] = Auth::id();
            $body['product_id'] = $data['product_id'];
            $body['status'] = 'renting';
            $body['renting_date_init'] = Carbon::now();
            $body['renting_date_finish'] = Carbon::now()->addDays($data['renting_days']);
            $body['price_total_renting'] = $data['price_total_renting'];
            $product = Product::find($body['product_id']);
            if ($body['user_id'] == $product['user_id']) {
                return response(['messaje' => 'El vehiculo no puede ser rentado por su dueño'], 500);
            }
            if ($product['status_for_renting'] != 'enabled') {
                return response(['messaje' => 'El vehiculo no está disponible para rentar'], 500);
            }
            $order = Order::create($body);
            $product->update(['status_for_renting' => 'renting']);
            $order = $order->load('user', 'product');
            return response($order, 201);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }
    public function enable(Request $request)
    {
        try {
            $order_id = $request['order_id'];
            $product_id = $request['product_id'];
            $user = Auth::user();
            $order = Order::find($order_id);
            $product = Product::find($product_id);
            if($user->id =! $order->user_id && $user->role != 'admin'){
                return response(['messaje'=>'la renta que quiere actualizar no corresponde a este usuario'],500);
            }
            $order->update(['status' => 'finish']);
            $product->update(['status_for_renting' => 'enabled']);
            return response([$order, $product], 201);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $body = $request->validate([
                'status' => 'required|string'
            ]);
            $user = Auth::user();
            $order = Order::find($id);
            if($user->id =! $order->user_id && $user->role != 'admin'){
                return response(['messaje'=>'la renta que quiere actualizar no corresponde a este usuario'],500);
            }
            $order->update($body);
            return response($order, 201);
        } catch (\Exception $e) {
            return response($e, 500);
        }
    }
}
