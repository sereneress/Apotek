<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Insert people
        $personId = DB::table('people')->insertGetId([
            'name' => 'Administrator',
            'sex' => 'L',
            'pob' => 'Jakarta',
            'dob' => '1990-01-01',
            'personable_type' => 'admin',
            'personable_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2️⃣ Insert user
        $userId = DB::table('users')->insertGetId([
            'person_id' => $personId,
            'username' => 'superadmin',
            'email' => 'admin@apotik.com',
            'password' => Hash::make('admin123'),
            'reference_type' => 'admin', // sesuai permintaan
            'reference_id' => null,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3️⃣ Insert role admin (jika belum ada)
        $roleId = DB::table('roles')->insertGetId([
            'name' => 'admin',
            'guard_name' => 'web',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4️⃣ Hubungkan user dengan role
        DB::table('role_user')->insert([
            'user_id' => $userId,
            'role_id' => $roleId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}