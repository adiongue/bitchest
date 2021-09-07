<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Sign in an user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user) {
            return response(['message' => 'EMAIL_NOT_FOUND'], 400);
        }

        if (!Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'INVALID_PASSWORD'], 400);
        }

        $token = $user->createToken('bitchesttoken')->plainTextToken;
        $role = "";
        if ($user->is_admin) {
            $role = 'admin';
        } else {
            $role = "client";
        }
        return response(["token" => $token, "role" => $role]);
    }

    /**
     * Sign in an user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return response(["message" => "log out"], 200);
    }

}
