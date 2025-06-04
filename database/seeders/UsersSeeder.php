<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Priadi',
                'email' => 'Priadi123@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'petani',
            ],
            [
                'name' => 'Suwarno',
                'email' => 'Suwarno123@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'petani',
            ]
        ]);
    }
}
