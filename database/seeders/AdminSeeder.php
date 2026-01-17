<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create or fetch admin role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Create admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'verified' => true,
            ]
        );

        // Attach role manually using your own pivot
        $admin->roles()->syncWithoutDetaching([$adminRole->id]);
    }
}
