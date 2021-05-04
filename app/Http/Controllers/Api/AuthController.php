<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',

        ]);

        $user = new User;

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->api_token = bin2hex(openssl_random_pseudo_bytes(30));
        if ($request->hasFile('photo')) {
            $user->photo = $request->photo->store('image');
        }

        $user->save();

        return new UserResource($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $userName = $request->input('email');
        $creadetial = $request->only('email', 'password');

        if (Auth::attempt($creadetial)) {
            $user = User::where('email', $userName)->first();
            return new UserResource($user);
        }

        $message = [
            'error' => true,
            'message' => 'User Login attempt failed',
        ];

        return response($message, 401);
    }
}
