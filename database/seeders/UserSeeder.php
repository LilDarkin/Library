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
        $users = [
            [
                'active' => 1,
                'created_at' => now(),
                'email' => 'student1@example.com',
                'email_verified_at' => now(),
                'name' => 'Student 1',
                'password' => Hash::make('123'),
                'remember_token' => Str::random(10),
                'role' => 1,
                'student_no' => '20240001',
                'emp_no' => null,
                'updated_at' => now(),
                'user_id' => Str::uuid(),
            ],
            [
                'active' => 1,
                'created_at' => now(),
                'email' => 'student2@example.com',
                'email_verified_at' => now(),
                'name' => 'Student 2',
                'password' => Hash::make('123'),
                'remember_token' => Str::random(10),
                'role' => 1,
                'student_no' => '20240002',
                'emp_no' => null,
                'updated_at' => now(),
                'user_id' => Str::uuid(),
            ],
            [
                'active' => 1,
                'created_at' => now(),
                'email' => 'teacher@example.com',
                'email_verified_at' => now(),
                'name' => 'Teacher',
                'password' => Hash::make('123'),
                'remember_token' => Str::random(10),
                'role' => 2,
                'student_no' => null,
                'emp_no' => '20240003',
                'updated_at' => now(),
                'user_id' => Str::uuid(),
            ],
            [
                'active' => 1,
                'created_at' => now(),
                'email' => 'librarian@example.com',
                'email_verified_at' => now(),
                'name' => 'Librarian',
                'password' => Hash::make('123'),
                'remember_token' => Str::random(10),
                'role' => 3,
                'student_no' => null,
                'emp_no' => '20240003',
                'updated_at' => now(),
                'user_id' => Str::uuid(),
            ],
            [
                'active' => 1,
                'created_at' => now(),
                'email' => 'admin@example.com',
                'email_verified_at' => now(),
                'name' => 'Admin',
                'password' => Hash::make('123'),
                'remember_token' => Str::random(10),
                'role' => 0,
                'student_no' => null,
                'emp_no' => null,
                'updated_at' => now(),
                'user_id' => Str::uuid(),
            ],
        ];

        DB::table('users')->insert($users);

        $uuids = array_column($users, 'user_id');
        file_put_contents(database_path('uuids.json'), json_encode($uuids));
    }
}
