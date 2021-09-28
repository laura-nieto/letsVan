<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'lastname'=>'Admin',
            'phone'=>'1234567',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role'=>1
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'lastname'=>'User',
            'phone'=>'1234567',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
        ]);
    }
}
