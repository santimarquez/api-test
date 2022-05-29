<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ResponseController as Response;
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
            return Response::send("Group correctly created.", 201);
        } else {
            return Response::send("Error creating the group.", 500);
        }
    }

    public function delete(Request $request, $id) {

        $group = Group::find($id);

        if(empty($group)) {
            return Response::send("The group doesn't exists.", 400);
        }

        if(!empty(UserGroup::where(["id_group" => $id])->first())) {
            return Response::send("We can't delete the group. It still have some members.", 400);
        }

        if ($group->delete()) {
            return Response::send("Group correctly deleted.", 200);
        } else {
            return Response::send("Error deleting the group.", 500);
        }
    }

    public function addToGroup(Request $request, $id, $user_id) {

        $this->checkUserGroup($user_id, $id);

        if(UserGroup::where([
            "id_group" => $id,
            "id_user" => $user_id
        ])->first()){
            return Response::send("The user already belongs to that group.", 400);
        }

        $userGroup = new UserGroup();
        $userGroup->id_user = $user_id;
        $userGroup->id_group = $id;

        if($userGroup->save()) {
            return Response::send("User correctly added to the group.", 201);
        } else {
            return Response::send("Error adding user to the group.", 500);
        }
    }

    public function removeFromGroup(Request $request, $id, $user_id) {

        $this->checkUserGroup($user_id, $id);

        $userGroup = UserGroup::where([
            "id_user" => $user_id,
            "id_group" => $id
        ])->first();

        if(empty($userGroup)) {
            return Response::send("The user doesn't belong to the selected group.", 400);
        }

        if($userGroup->delete()) {
            return Response::send("User correctly removed from the group.", 200);
        } else {
            return Response::send("Error removing user from the group.", 500);
        }
    }

    private function checkUserGroup($user_id, $group_id) {

        if(empty(Group::find($group_id))) {
            return Response::send("The group doesn't exists.", 400);
        }

        if(empty(User::find($user_id))) {
            return Response::send("The user doesn't exists.", 400);
        }
    }
}
