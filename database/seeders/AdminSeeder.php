<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'role' => 'admin'
        ]);

        // Jika ingin menggunakan Role dan Permission, sebaiknya gunakan Model:
        /*
        use App\Models\Admin;

        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $admin->assignRole('admin');
        */
    }
}
