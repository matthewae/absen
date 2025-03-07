<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('mandajaya'),
            'staff_id' => 'ADMIN001',
            'role' => 'admin',
        ]);

        $supervisor = User::create([
            'name' => 'Supervisor User',
            'email' => 'supervisor@supervisor.com',
            'password' => Hash::make('mandajaya'),
            'staff_id' => 'SPV001',
            'role' => 'supervisor',
            'department' => 'IT',
            'position' => 'Team Lead'
        ]);

        User::create([
            'name' => 'Staff User',
            'email' => 'staff@staff.com',
            'password' => Hash::make('mandajaya'),
            'staff_id' => 'STAFF001',
            'role' => 'staff',
            'supervisor_id' => $supervisor->staff_id,
            'department' => 'IT',
            'position' => 'Developer'
        ]);
    }
}
