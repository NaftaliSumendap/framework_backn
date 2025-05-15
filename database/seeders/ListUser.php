<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ListUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
        [
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // HARUS di-hash dengan bcrypt
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ],
        [
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('password123'), // HARUS di-hash dengan bcrypt
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]
    ]);
    }
}
