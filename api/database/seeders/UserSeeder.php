<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'id_role' => 1,
            'user_name' => 'admin_user',
            'password' => Hash::make('123pwd'),
            'update_time' => Carbon::now()
        ]);
        DB::table('user')->insert([
            'id_role' => 2,
            'user_name' => 'regular_user',
            'password' => Hash::make('123pwd'),
            'update_time' => Carbon::now()
        ]);
    }
}
