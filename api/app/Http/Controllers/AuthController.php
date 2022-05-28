<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth(Request $request) {
        $request->validate([
            'user_name' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('user_name', "=", $request->user_name)->first();

        if(isset($user) && Hash::check($request->password, $user->password)) {
            return response()->json([
                "msg" => "Correct credentials",
                "access_token" => $user->createToken("auth_token")->plainTextToken
            ], 200);
        } else {
            return response()->json(["msg" => "Wrong credentials"], 400);
        }
    }
}
