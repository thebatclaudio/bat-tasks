<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (Auth::attempt([
            "email" => $request->string("email"),
            "password" => $request->string("password"),
        ])) {
            $token = $request->user()->createToken("API");

            return ['token' => $token->plainTextToken];
        }

        return response()->json([
            "error" => "Wrong credentials"
        ], 401);
    }
}
