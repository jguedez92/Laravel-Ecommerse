<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function getAll()
    {
        try {
            $products = Product::get();
            return response($products->load('category'));
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function getProductsByUser($user_id)
    {
        try {
            $products = Product::where('user_id', $user_id)->get();
            return response($products->load('category'));
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function insert(Request $request)
    {
        try {
            $categoriesIds = Category::all()->map(fn ($category) => $category->id)->toArray();
            $body = $request->validate([
                'brand' => 'required|string|max:10',
                'model' => 'required|string|max:20',
                'motor' => 'required|string|max:10',
                'licence' => 'required|string|max:2',
                'status' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'string',
                'category_id' => 'required|integer|in:' . implode(',', $categoriesIds),
                'user_id' => 'required|integer'

            ]);
            $product = Product::create($body);
            return response($product->load('category'), 201);
            return response($product, 201);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function update(Request $request, $product_id, $user_id)
    {
        try {
            $categories = Category::all();
            $categoriesIds = $categories->map(fn ($category) => $category->id)->toArray();
            $body = $request->validate([
                'brand' => 'string|max:10',
                'model' => 'string|max:20',
                'motor' => 'string|max:10',
                'licence' => 'string|max:2',
                'status' => 'string',
                'price' => 'numeric',
                'description' => 'string',
                'category_id' => 'integer|in:' . implode(',', $categoriesIds)
            ]);
            $product = Product::find($product_id);
            $user = User::find($user_id);
            if ($product['user_id'] !== $user['id'] or $user['role'] !== 'admin') {
                return response($message = 'no está autorizado para ejecutar esta accion', 500);
            }
            $product->update($body);
            return response($product->load('category'));
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function delete($product_id, $user_id)
    {
        try {
            $product = Product::find($product_id);
            $user = User::find($user_id);
            if ($user['role'] !== 'admin') {
                return response($message = 'no está autorizado para ejecutar esta accion', 500);
            }
            $product->delete();
            return response([
                'message' => 'Producto eliminado con éxito',
                'product' => $product
            ]);
        } catch (\Exception $e) {
            return response([
                'error' => $e,
            ], 500);
        }
    }
}
