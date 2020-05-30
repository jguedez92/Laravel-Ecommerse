<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function getAll()
    {
        try {
            $products = Product::get();
            return response($products->load('categories'));
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
                'name' => 'required|string|max:40',
                'status' => 'required|string',
                'price' => 'required|numeric',
                'description' => 'string',
                'categories' => 'required|array|in:' . implode(',', $categoriesIds)

            ]);
            $categories = $body['categories'];
            unset($body['categories']);
            $product = Product::create($body);
            $product->categories()->attach($categories);
            return response($product->load('categories'), 201);
            return response($product, 201);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $categories = Category::all();
            $categoriesIds = $categories->map(fn ($category) => $category->id)->toArray();
            $body = $request->validate([
                'name' => 'string|max:40',
                'price' => 'numeric',
                'description' => 'string',
                'categories' => 'array|in:' . implode(',', $categoriesIds)
            ]);
            $product = Product::find($id);
            if ($request->has('categories')) {
                $categories = $body['categories'];
                unset($body['categories']);
                $product->update($body);
                $product->categories()->sync($categories);
            }else {
                $product->update($body);
            }
            return response($product->load('categories'));
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function delete($id)
    {
        try {
            $product = Product::find($id);
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
