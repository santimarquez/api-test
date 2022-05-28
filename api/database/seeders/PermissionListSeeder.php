<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_list')->insert([
            'id' => 1,
            'permission_name' => 'adduser'
        ]);
        DB::table('permission_list')->insert([
            'id' => 2,
            'permission_name' => 'deleteuser'
        ]);
        DB::table('permission_list')->insert([
            'id' => 3,
            'permission_name' => 'whoami'
        ]);
        DB::table('permission_list')->insert([
            'id' => 4,
            'permission_name' => 'logout'
        ]);
        DB::table('permission_list')->insert([
            'id' => 5,
            'permission_name' => 'addgroup'
        ]);
        DB::table('permission_list')->insert([
            'id' => 6,
            'permission_name' => 'deletegroup'
        ]);
        DB::table('permission_list')->insert([
            'id' => 7,
            'permission_name' => 'addToGroup'
        ]);
        DB::table('permission_list')->insert([
            'id' => 8,
            'permission_name' => 'removeFromGroup'
        ]);
    }
}
