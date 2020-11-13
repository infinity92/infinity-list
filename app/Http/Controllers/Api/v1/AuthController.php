<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user || !$user->hasVerifiedEmail() || !Hash::check($request->password, $user->password)) {
            return response(['message' => 'These credentials do not match our records.'], 404);
        }

        $token = $user->createToken('user_auth_token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response($response, 201);
    }
}
