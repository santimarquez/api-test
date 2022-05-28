<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

        if($user->save()) {
            return response()->json([
                "msg" => "User correctly added"
            ], 200);
        } else{
            return response()->json([
                "msg" => "Error adding the user"
            ], 500);
        }

    }

    public function delete(Request $request, $id) {

        if ($id == Auth::user()->id) {
            return response()->json(["msg" => "Sorry, you can't delete yourself"], 400);
        }

        if(empty(User::find($id))) {
            return response()->json(["msg" => "The user doesn't exist"], 400);
        }

        if (User::where('id', $id)->delete()) {
            return response()->json([
                "msg" => "User correctly deleted"
            ], 200);
        } else {
            return response()->json(["msg" => "Error deleting the user"], 500);
        }

    }

    public function whoami() {
        return Auth::user();
    }
    

    public function logout() {
        if(Auth::user()->tokens()->delete()) {
            return response()->json([
                "msg" => "User correctly logged out"
            ], 200);
        } else{
            return response()->json([
                "msg" => "Error logging out"
            ], 500);
        }
    }
}
