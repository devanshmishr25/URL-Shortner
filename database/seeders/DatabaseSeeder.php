<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create SuperAdmin account
        DB::table('companies')->insert([
            'id' => 1,
            'name' => 'Super Admin Company',
            'created_by' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'password' => Hash::make('password123'),
            'company_id' => 1,
            'role' => 'SuperAdmin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create test company with Admin
        DB::table('companies')->insert([
            'id' => 2,
            'name' => 'Test Company',
            'created_by' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'id' => 2,
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'company_id' => 2,
            'role' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create test Member
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'Member User',
            'email' => 'member@example.com',
            'password' => Hash::make('password123'),
            'company_id' => 2,
            'role' => 'Member',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Create test Manager
        DB::table('users')->insert([
            'id' => 4,
            'name' => 'Manager User',
            'email' => 'manager@example.com',
            'password' => Hash::make('password123'),
            'company_id' => 2,
            'role' => 'Manager',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
