<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\UserGroup;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function add(Request $request) {
        
        $request->validate([
            'group_name' => 'required|unique:App\Models\Group|min:4|max:100'
        ]);

        $group = new Group();
        $group->group_name = $request->group_name;

        if($group->save()) {
            return response()->json([
                "msg" => "Group correctly created."
            ], 201);
        } else {
            return response()->json([
                "msg" => "Error creating the group."
            ], 500);
        }
    }

    public function delete(Request $request, $id) {

        $group = Group::find($id);

        if(empty($group)) {
            return response()->json(["msg" => "The group doesn't exists."], 400);
        }

        if(!empty(UserGroup::where(["id_group" => $id])->first())) {
            return response()->json(["msg" => "We can't delete the group. It still have some members."], 400);
        }

        if ($group->delete()) {
            return response()->json([
                "msg" => "Group correctly deleted."
            ], 200);
        } else {
            return response()->json(["msg" => "Error deleting the group. T"], 200);
        }
    }

    public function addToGroup(Request $request, $id, $user_id) {

        if(empty(Group::find($id))) {
            return response()->json(["msg" => "The group doesn't exists."], 400);
        }

        if(empty(User::find($user_id))) {
            return response()->json(["msg" => "The user doesn't exists."], 400);
        }

        if(UserGroup::where([
            "id_group" => $id,
            "id_user" => $user_id
        ])->first()){
            return response()->json(["msg" => "The user already belongs to that group."], 400);
        }

        $userGroup = new UserGroup();
        $userGroup->id_user = $user_id;
        $userGroup->id_group = $id;

        if($userGroup->save()) {
            return response()->json([
                "msg" => "User correctly added to the group."
            ], 200);
        } else {
            return response()->json([
                "msg" => "Error adding user to the group."
            ], 500);
        }
    }

    public function removeFromGroup(Request $request, $id, $user_id) {

        if(empty(Group::find($id))) {
            return response()->json(["msg" => "The group doesn't exists."], 400);
        }

        if(empty(User::find($user_id))) {
            return response()->json(["msg" => "The user doesn't exists."], 400);
        }

        $userGroup = UserGroup::where([
            "id_user" => $user_id,
            "id_group" => $id
        ])->first();

        if(empty($userGroup)) {
            return response()->json(["msg" => "The user doesn't belong to the selected group."], 400);
        }

        if($userGroup->delete()) {
            return response()->json([
                "msg" => "User correctly removed from the group."
            ], 200);
        } else {
            return response()->json([
                "msg" => "Error removing user from the group."
            ], 500);
        }
    }
}
