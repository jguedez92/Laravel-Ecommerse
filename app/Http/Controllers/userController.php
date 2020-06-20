<?php

namespace App\Http\Controllers;

use App\Mail\UserConfirm;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getAll()
    {
        try {
            $users = User::get();
            return response($users->load('product.category','order.product'), 201);
        } catch (\Exception $e) {
            return response($message = 'Ha ocurrido un problema... intenténtelo más tarde', 500);
        }
    }
    public function getbyAuth()
    {
        try {
            $id = Auth::id();
            $user = User::find($id);
            return response($user->load('product.category','order.product'));
        } catch (\Exception $e) {
            return response($message = 'Ha ocurrido un problema... intenténtelo más tarde', 500);
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
    public function register(Request $request)
    {
        try {
            dd($request);
            $body = $request->all();
            $emailExist = User::where('email', $body['email'])->first();
            if ($emailExist) {
                return response($message = 'El email ya esta en uso', 500);
            }
            $body['password'] = Hash::make($body['password']);
            $body['confirmation_code'] = sha1($body['email']);
            $user = User::create($body);
            Mail::to($user->email)->send(new UserConfirm($user));
            return response($user, 201);
        } catch (\Exception $e) {
            return response($message = 'Ha ocurrido un problema... intenténtelo más tarde', 500);
        }
    }
    public function confirmation($code)
    {
        try {
            $user = User::where('confirmation_code', $code)->first();
            if (!$user) {
                return response(['message' => 'El codigo de confirmación ha expirado o no existe']);
            }
            $body = [
                'confirmation_code' => null,
                'email_verified_at' => Carbon::now()
            ];
            $user->update($body);
            return response(redirect('http://localhost:3000/confirmation'));
        } catch (\Exception $e) {
            return response($message = 'Ha ocurrido un problema... intenténtelo más tarde', 500);
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
            $id = Auth::id();
            $user = User::find($id);
            if (!$user->email_verified_at) {
                return response([
                    'message' => 'debe confirmar la cuenta a través de su correo electronico para poder ingresar',
                ], 400);
            }
            $token = $user->createToken('authToken')->accessToken;
            return response([
                'user' => $user->load('product.category','order.product'),
                'token' => $token,
                'message' => 'Bienvenido ' . $user->fullName
            ], 200);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function logout(Request $request)
    {
        try {
            Auth::user()->token()->delete();
            return response([
                'message' => 'La sesion se ha cerrado correctamente'
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'hubo un error al tratar de cerrar sesion',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        try {
            $body = $request->validate([
                'name' => 'string|max:20',
                'email' => 'string',
                'license' => 'string',
                'status_for_renting' => 'string',
                'password' => 'string|max:15',
                'role' => 'string'
            ]);
            $user = User::find($id);
            $user->update($body);
            return response([
                'message' => ' user succesfully updated'
            ]);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function updatePassword(Request $request)
    {
        try {
            $credentials = $request->only('email', 'password');
            if (!Auth::attempt($credentials)) {
                return response([
                    'message' => 'contraseña Invalida',
                ], 400);
            }
            $newPassword = $request->validate([
                'new_password' => 'required|string|max:15',
            ]);
            $body['password'] = Hash::make($newPassword['new_password']);
            $id = Auth::id();
            $user = User::find($id);
            $user->update($body);
            return response([
                'message' => ' Contraseña Actualizada'
            ]);
        } catch (\Exception $e) {
            return response([
                'error' => $e->getMessage() . '\n'
            ], 500);
        }
    }
    public function uploadImgProfile(Request $request)
    {
        try {
            $request->validate(
                ['profileImg' => 'image|mimes:jpeg,png,jpg|max:2048'],
            );
            $id = Auth::id();
            $user = User::find($id);
            $imageName = time() . '-' . request()->profileImage->getClientOriginalName();
            request()->profileImage->move('images/users/', $imageName);
            $user->update(['profile_image_path' => $imageName]);
            return response($user);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
    public function uploadImgDni(Request $request)
    {
        try {
            $request->validate(
                ['dniImg' => 'image|mimes:jpeg,png,jpg|max:2048'],
            );
            $id = Auth::id();
            $user = User::find($id);
            $imageName = time() . '-' . request()->dniImage->getClientOriginalName();
            request()->dniImage->move('images/users/', $imageName);
            $user->update(['dni_image_path' => $imageName]);
            return response($user);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
    public function uploadImgLicense(Request $request)
    {
        try {
            $request->validate(
                ['LicenseImg' => 'image|mimes:jpeg,png,jpg|max:2048'],
            );
            $id = Auth::id();
            $user = User::find($id);
            $imageName = time() . '-' . request()->licenseImage->getClientOriginalName();
            request()->licenseImage->move('images/users/', $imageName);
            $user->update(['license_image_path' => $imageName]);
            return response($user);
        } catch (\Exception $e) {
            return response([
                'message' => $e,
            ], 500);
        }
    }
    public function delete($id)
    {
        try {
            $role = Auth::user()->role;
            if ($role == 'user') {
                return response(['messaje' => 'usted no tiene privilegios para realizar esta accion'], 500);
            }
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
