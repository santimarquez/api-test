<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    public function add(Request $request) {
        $request->validate([
            'id_role' => 'required|exists:App\Models\Role,id',
            'user_name' => 'required|unique:App\Models\User|min:4|max:100',
            'password' => 'required|confirmed'
        ]);

        $user = new User();
        
        $user->id_role = $request->id_role;
        $user->user_name = $request->user_name;
        $user->password = Hash::make($request->password);
        $user->update_time = Carbon::now();
        $user->save();

        return response()->json([
            "msg" => "User correctly added"
        ], 200);
    }
}
