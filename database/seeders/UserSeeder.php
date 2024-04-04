<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Generate user data
        $users = [
            [
                'active' => 1,
                'created_at' => '2024-04-04 13:56:36',
                'email' => 'john@example.com',
                'email_verified_at' => '2024-04-04 13:56:36',
                'name' => 'Student 1',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 1,
                'student_no' => '20240001',
                'emp_no' => null,
                'updated_at' => '2024-04-04 13:56:36',
                'user_id' => Str::uuid(),
            ],
            [
                'active' => 1,
                'created_at' => '2024-04-04 13:56:36',
                'email' => 'jane@example.com',
                'email_verified_at' => '2024-04-04 13:56:36',
                'name' => 'Student 2',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 1,
                'student_no' => '20240002',
                'emp_no' => null,
                'updated_at' => '2024-04-04 13:56:36',
                'user_id' => Str::uuid(),
            ],
            [
                'active' => 1,
                'created_at' => '2024-04-04 13:56:36',
                'email' => 'eon@example.com',
                'email_verified_at' => '2024-04-04 13:56:36',
                'name' => 'Teacher',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 2,
                'student_no' => null,
                'emp_no' => '20240003',
                'updated_at' => '2024-04-04 13:56:36',
                'user_id' => Str::uuid(),
            ],
            [
                'active' => 1,
                'created_at' => '2024-04-04 13:56:36',
                'email' => 'admin@example.com',
                'email_verified_at' => '2024-04-04 13:56:36',
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'role' => 3,
                'student_no' => null,
                'emp_no' => null,
                'updated_at' => '2024-04-04 13:56:36',
                'user_id' => Str::uuid(),
            ],
        ];

        DB::table('users')->insert($users);

        // Save UUIDs for later use in StudentsTableSeeder
        $uuids = array_column($users, 'user_id');
        file_put_contents(database_path('uuids.json'), json_encode($uuids));
    }
}
