<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class productController extends Controller
{
    public function getAll()
    {
        try {
            $products = Product::get();
            return response($products->load('category','user'));
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function getProductsByUserId()
    {
        try {
            $user = Auth::user();
            $products = Product::where('user_id', $user['id'])->get();
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
            //dd($request);
            $categoriesIds = Category::all()->map(fn ($category) => $category->id)->toArray();
            $body = $request->validate([
                'brand' => 'required|string|max:20',
                'model' => 'required|string|max:20',
                'motor' => 'required|string|max:20',
                'year' => 'required|string|max:20',
                'city' => 'required|string|max:20',
                'required_license' => 'required|string|max:20',
                'status_for_renting' => 'required|string',
                'price' => 'required|integer',
                'description' => 'required|string',
                'category_id' => 'required|integer|in:' . implode(',', $categoriesIds),
                'user_id' => 'required|integer'
            ]);
            $product = Product::create($body);
            return response($product->load('category'), 201);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function uploadImage(Request $request, $product_id)
    {
        try {
            $user = Auth::user();
            $product = Product::find($product_id);
            if ($user->id != $product->user_id) {
                return response(['message' => 'AUTORIZACION DENEGADA: El producto no pertenece a este usuario']);
            }
            $request->validate(
                ['image_path_1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
                ['image_path_2' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
                ['image_path_3' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
                ['image_path_4' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'],
                ['permit_circulation_image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048']
            );
            $imageName = [];
            for ($i = 0; $i <= 4; $i++) {
                if ($i < 4) {
                    $imageName[$i] = time() . '-' . $request['image_path_' . ($i + 1)]->getClientOriginalName();
                    $request['image_path_' . ($i + 1)]->move('images/products/', $imageName[$i]);
                }else{
                    $imageName[$i] = time() . '-' . $request['permit_circulation_image_path']->getClientOriginalName();
                    $request['permit_circulation_image_path']->move('images/products/', $imageName[$i]);
                }
            }
            
            $product->update([
                'image_path_1' => $imageName[0],
                'image_path_2' => $imageName[1],
                'image_path_3' => $imageName[2],
                'image_path_4' => $imageName[3],
                'permit_circulation_image_path' => $imageName[4]
            ]);
            return response($product);
        } catch (\Exception $e) {
            return response([
                'error' => $e,
            ], 500);
        }
    }
    public function uploadImg1(Request $request, $id)
    {
        try {
            $request->validate(
                ['file' => 'image|mimes:jpeg,png,jpg|max:2048'],
            );
            $product = Product::find($id);
            $imageName = time() . '-' . request()->file->getClientOriginalName();
            request()->file->move('images/products/', $imageName);
            $product->update(['image_path_1' => $imageName]);
            return response($product);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
    public function uploadImg2(Request $request, $id)
    {
        try {
            $request->validate(
                ['file' => 'image|mimes:jpeg,png,jpg|max:2048'],
            );
            $product = Product::find($id);
            $imageName = time() . '-' . request()->file->getClientOriginalName();
            request()->file->move('images/products/', $imageName);
            $product->update(['image_path_2' => $imageName]);
            return response($product);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
    public function uploadImg3(Request $request, $id)
    {
        try {
            $request->validate(
                ['file' => 'image|mimes:jpeg,png,jpg|max:2048'],
            );
            $product = Product::find($id);
            $imageName = time() . '-' . request()->file->getClientOriginalName();
            request()->file->move('images/products/', $imageName);
            $product->update(['image_path_3' => $imageName]);
            return response($product);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
    public function uploadImg4(Request $request, $id)
    {
        try {
            $request->validate(
                ['file' => 'image|mimes:jpeg,png,jpg|max:2048'],
            );
            $product = Product::find($id);
            $imageName = time() . '-' . request()->file->getClientOriginalName();
            request()->file->move('images/products/', $imageName);
            $product->update(['image_path_4' => $imageName]);
            return response($product);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
    public function uploadPermitConduction(Request $request, $id)
    {
        try {
            $request->validate(
                ['file' => 'image|mimes:jpeg,png,jpg|max:2048'],
            );
            $product = Product::find($id);
            $imageName = time() . '-' . request()->file->getClientOriginalName();
            request()->file->move('images/products/', $imageName);
            $product->update(['permit_circulation_image_path' => $imageName]);
            return response($product);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
    public function update(Request $request, $product_id)
    {
        try {
            $categories = Category::all();
            $categoriesIds = $categories->map(fn ($category) => $category->id)->toArray();
            $body = $request->validate([
                'brand' => 'string|max:10',
                'model' => 'string|max:20',
                'motor' => 'string|max:10',
                'year' => 'string|max:20',
                'city' => 'string|max:20',
                'required_license' => 'string|max:20',
                'status_for_renting' => 'string',
                'price' => 'integer',
                'description' => 'string',
                'category_id' => 'integer|in:' . implode(',', $categoriesIds)
            ]);
            $user = Auth::user();
            $product = Product::find($product_id);
            if ($user->id != $product->user_id && $user->role == 'user') {
                return response(['message' => 'AUTORIZACION DENEGADA: El producto no pertenece a este usuario']);
            }
            $product->update($body);
            return response($product->load('category'));
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function enableProduct( $product_id)
    {
        try {
            $user = Auth::user();
            $product = Product::find($product_id);
            if ($user->id != $product->user_id && $user->role != 'admin') {
                return response(['message' => 'AUTORIZACION DENEGADA: El producto no pertenece a este usuario']);
            }
            $body['status_for_renting'] = 'enabled';
            $product->update($body);
            return response($product->load('category'));
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function delete($product_id)
    {
        try {
            $product = Product::find($product_id);
            /*$user = Auth::user();
            if ($user['role'] != 'admin') {
                return response($message = 'no está autorizado para ejecutar esta accion', 500);
            }*/
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
