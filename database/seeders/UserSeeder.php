<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Mg Kaung',
                'user_name' => 'mgkaung',
                'phone_number' => '0978334223',
                'user_type_id' => 3,
                'email' => 'mgkaung@gmail.com',
                'password' => Hash::make('password'), // Or the hash from your SQL
                'qr_code_path' => 'qrcodes/7/PaMaNa(N)000831.svg',
                'profile_image' => '1758513638.jpg',
                'nrc_number' => '7/PaMaNa(N)000831',
                'verified' => '1',
                'created_at' => '2025-09-22 04:00:38',
                'updated_at' => '2025-09-22 04:58:44',
            ],
            // Add other user records from your .sql file here...
        ]);
    }
}
