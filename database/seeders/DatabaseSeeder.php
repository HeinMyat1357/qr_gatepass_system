<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // RoleSeeder::class,
            // UserTypeSeeder::class,
            // AdminSeeder::class,
            UserSeeder::class,
           
        ]);
        // 1. Seed Roles
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'admin', 'created_at' => '2025-08-09 03:22:53', 'updated_at' => '2025-08-09 03:22:53'],
            ['id' => 2, 'name' => 'moderator', 'created_at' => '2025-08-09 03:22:53', 'updated_at' => '2025-08-09 03:22:53'],
            ['id' => 3, 'name' => 'user', 'created_at' => '2025-08-09 03:22:53', 'updated_at' => '2025-08-09 03:22:53'],
        ]);

        // 2. Seed User Types
        DB::table('user_types')->insert([
            ['id' => 1, 'name' => 'Student', 'is_verified' => 1, 'created_at' => '2025-08-09 03:22:53'],
            ['id' => 2, 'name' => 'Teacher', 'is_verified' => 1, 'created_at' => '2025-08-09 03:22:53'],
            ['id' => 3, 'name' => 'Visitor', 'is_verified' => 0, 'created_at' => '2025-08-09 03:22:53'],
            ['id' => 4, 'name' => 'Staff', 'is_verified' => 0, 'created_at' => '2025-08-10 21:53:58'],
            ['id' => 9, 'name' => "Teacher's Family Member", 'is_verified' => 0, 'created_at' => '2025-09-19 00:33:16'],
        ]);

        // 3. Seed Locations
        DB::table('locations')->insert([
            ['id' => 1, 'name' => 'Main Gate', 'created_at' => '2025-08-13 21:32:00'],
            ['id' => 2, 'name' => 'Library', 'created_at' => '2025-08-18 09:30:33'],
            ['id' => 3, 'name' => 'Canteen', 'created_at' => '2025-08-18 09:30:56'],
        ]);

        // 4. Seed Primary Users (Admin and Moderator)
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'user_name' => null,
                'phone_number' => '09670786443',
                'user_type_id' => 1,
                'email' => 'admin@gmail.com',
                'password' => '$2y$12$yt0imAcyDkWQ/FctyAShz.tl8L6/okqmPgbppXfNmBmrC1Rh7orxS',
                'verified' => '1',
                'created_at' => '2025-08-09 03:22:53'
            ],
            [
                'id' => 4,
                'name' => 'U Bo Bo',
                'user_name' => null,
                'phone_number' => '09698764330',
                'user_type_id' => 2,
                'email' => 'ubo@gmail.com',
                'password' => '$2y$12$D1yJnEcNYJFwa0wXebfxk.OyZRTKFTx0Ckwcd7XaPQDfvryrbC44C',
                'verified' => '1',
                'created_at' => '2025-08-09 09:12:10'
            ],
        ]);

        // 5. Assign Roles to Users
        DB::table('role_user')->insert([
            ['user_id' => 1, 'role_id' => 1], // admin@gmail.com is Admin
            ['user_id' => 4, 'role_id' => 2], // ubo@gmail.com is Moderator
        ]);

       
    }
}