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
    public function register(Request $request)
    {
        try {
            $body = $request->all();
            $emailExist = User::where('email', $body['email'])->first();
            if ($emailExist) {
                return response($message = 'El email ya esta en uso', 500);
            }
            $body['password'] = Hash::make($body['password']);
            $code = rand($min = 100000, $max = 999999);
            $body['confirmation_code'] = "{$code}";
            $user = User::create($body);
            Mail::to($user->email)->send(new UserConfirm($user));
            return response(['userId' => $user->id], 201);
        } catch (\Exception $e) {
            return response(['message' =>  $e], 500);
        }
    }
    public function confirmation(Request $request)
    {
        try {
            $id = $request['id'];
            $code = $request['confirmation_code'];
            $user = User::find($id);
            if($user->confirmation_code != $code){
                return response($message = 'El codigo ingresado es incorrecto', 500);
            }
            $user->update(['email_verified_at'=>Carbon::now(), 'confirmation_code'=>null]);
            return response($user, 201);
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
                ], 500);
            }
            $id = Auth::id();
            $user = User::find($id);
            if (!$user->email_verified_at) {
                return response([
                    'message' => 'debe confirmar la cuenta para poder ingresar',
                    'user_activation' => $user->id
                ], 200);
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
            $user = Auth::user()->token()->delete();
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
