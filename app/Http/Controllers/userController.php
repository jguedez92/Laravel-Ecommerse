<?php

namespace App\Http\Controllers;

use App\Mail\UserConfirm;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class userController extends Controller
{
    public function getAll()
    {
        try {
            $user = User::get();
            return response($user->load('product.category'), 201);
        } catch (\Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function getById($id)
    {
        try {
            $user = User::find($id);
            return response($user->load('product.category'), 201);
        } catch (\Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }
    //sha1(time()) para generar hash
    public function register(Request $request)
    {
        try {
            $body = $request->all();
            $emailExist = User::where('email', $body['email'])->first();
            if ($emailExist) {
                return response($message = 'El email ya esta en uso', 500);
            }
            $body['password'] = Hash::make($body['password']);
            $body['confirmation_code']= sha1($body['email']);
            $user = new User($body);
            Mail::to($user->email)->send(new UserConfirm($user));
            $user->save();
            return response($user, 201);
        } catch (\Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n";
        }
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                return response([
                    'message' => 'email y/o contraseña invalido',
                ], 400);
            }
            $user = Auth::user();
            $token = $user->createToken('authToken')->accessToken;
            return response([
                'user' => $user,
                'token' => $token,
            ]);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $body = $request->validate([
                'name' => 'string|max:20',
                'email' => 'string',
                'password' => 'string|max:15',
                'role' => 'string'
            ]);
            $user = User::find($id);
            $user->update($body);
            return response([
                'message'=>' user succesfully updated'
            ]);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $user = User::find($id);
            $user->delete();
            return response([
                'message' => 'user succesfully deleted',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response([
                'error' => $e
            ], 500);
        }
    }
}
