<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Store a new user in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $fields = $request->validate([
            'firstname' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string', 'confirmed'],
            'is_admin' => ['required', 'boolean']
        ]);

        if (!array_key_exists('lastname', $fields)) {
            $fields['lastname'] = null;
        }
        if (!array_key_exists('address', $fields)) {
            $fields['address'] = null;
        }
        if (!array_key_exists('country', $fields)) {
            $fields['country'] = null;
        }

        $user = User::create([
            'firstname' => $fields['firstname'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'is_admin' => $fields['is_admin'],
            'address' => $fields['address'],
            'country' => $fields['country']
        ]);

        return response(["id" => $user->id], 201);
    }

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

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'bad creds'], 400);
        }

        $token = $user->createToken('bitchesttoken')->plainTextToken;
        return response($token, 201);
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
