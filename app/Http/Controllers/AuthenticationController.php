<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function login(Request $request)
     {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if(! $user || !Hash::check($request->password, $user->password))
        {
            throw ValidationException::withMessages([
                'email' => ['The provided crendentials are incorrect.']
            ]);
        }

        return $user->createToken('user login')->plainTextToken;
     }

     public function logout(Request $request)
     {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            "message" => "Logout Successfuly!"
        ]);
     }

     public function user(Request $request)
     {
        return response()->json(Auth::user());
     }
}
