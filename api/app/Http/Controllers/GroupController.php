<?php

namespace App\Http\Controllers;

use App\Models\Group;
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
                "msg" => "Group correctly created"
            ], 200);
        } else {
            return response()->json([
                "msg" => "Error creating the group"
            ], 500);
        }
    }

    public function delete(Request $request, $id) {
        if(empty(Group::find($id))) {
            return response()->json(["msg" => "The group doesn't exist"], 400);
        }

        if (Group::where('id', $id)->delete()) {
            return response()->json([
                "msg" => "Group correctly deleted"
            ], 200);
        } else {
            return response()->json(["msg" => "Error deleting the group"], 500);
        }
    }
}
