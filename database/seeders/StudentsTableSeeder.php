<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read UUIDs generated in UsersTableSeeder
        
        $uuids = json_decode(File::get(database_path('uuids.json')), true);

        // Generate student data and associate them with users
        $students = [
            [
                'user_uuid' => $uuids[0],
                'student_no' => '20240001',
                'name' => 'Student 1',
                'email' => 'john@example.com',
                'contact' => '123456789',
                'department' => 'Computer Science',
                'year' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_uuid' => $uuids[1],
                'student_no' => '20240002',
                'name' => 'Student 2',
                'email' => 'jane@example.com',
                'contact' => '987654321',
                'department' => 'Information Technology',
                'year' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more students as needed
        ];
        
        // Insert students into the database
        DB::table('students')->insert($students);
    }
}
