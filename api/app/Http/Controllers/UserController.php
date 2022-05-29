<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController as Response;
use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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

        if($user->save()) {
            return Response::send("User correctly added.", 201);
        } else{
            return Response::send("Error adding the user.", 500);
        }
    }

    public function delete(Request $request, $id) {

        if ($id == Auth::user()->id) {
            return Response::send("Sorry, you can't delete yourself.", 400);
        }

        if(empty(User::find($id))) {
            return Response::send("The user doesn't exist.", 400);
        }

        if(UserGroup::where("id_user", $id)) {
            return Response::send("The user can't be deleted. It still belongs to a group.", 400);
        }

        if (User::where('id', $id)->delete()) {
            return Response::send("User correctly deleted.", 200);
        } else {
            return Response::send("Error deleting the user.", 500);
        }
    }

    public function whoami() {

        return Auth::user();
    }
    

    public function logout() {
        
        if(Auth::user()->tokens()->delete()) {
            return Response::send("User correctly logged out.", 200);
        } else{
            return Response::send("Error logging out.", 500);
        }
    }
}
