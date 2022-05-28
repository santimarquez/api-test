<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Setting the admin's permissions
        DB::table('role_permission')->insert([
            'id_role' => 1,
            'id_permission' => 1
        ]);
        DB::table('role_permission')->insert([
            'id_role' => 1,
            'id_permission' => 2
        ]);
        DB::table('role_permission')->insert([
            'id_role' => 1,
            'id_permission' => 3
        ]);
        DB::table('role_permission')->insert([
            'id_role' => 1,
            'id_permission' => 4
        ]);
        DB::table('role_permission')->insert([
            'id_role' => 1,
            'id_permission' => 5
        ]);
        DB::table('role_permission')->insert([
            'id_role' => 1,
            'id_permission' => 6
        ]);
        DB::table('role_permission')->insert([
            'id_role' => 1,
            'id_permission' => 7
        ]);
        DB::table('role_permission')->insert([
            'id_role' => 1,
            'id_permission' => 8
        ]);

        //Setting the regular user's permissions
        DB::table('role_permission')->insert([
            'id_role' => 2,
            'id_permission' => 3
        ]);
        DB::table('role_permission')->insert([
            'id_role' => 2,
            'id_permission' => 4
        ]);
    }
}
