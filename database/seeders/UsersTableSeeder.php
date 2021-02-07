<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            // for admin
            [
                'full_name' => 'Golam Saklain',
                'username' => 'Admin',
                'email' => 'tonmoysaklain@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'admin',
                'status' => 'active',
            ],

            // for vendor
            [
                'full_name' => 'Golam Saklain',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'vendor',
                'status' => 'active',
            ],

            // for customer
            [
                'full_name' => 'Golam Saklain',
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('1234'),
                'role' => 'customer',
                'status' => 'active',
            ],
        ]);
    }
}
