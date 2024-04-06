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
        $uuids = json_decode(File::get(database_path('uuids.json')), true);

        $students = [
            [
                'user_id' => $uuids[0],
                'student_no' => '20241',
                'name' => 'Student 1',
                'email' => 'student1@example.com',
                'contact' => '123456789',
                'department' => 'Computer Science',
                'year' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $uuids[1],
                'student_no' => '20242',
                'name' => 'Student 2',
                'email' => 'student2@example.com',
                'contact' => '987654321',
                'department' => 'Information Technology',
                'year' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ];
        
        DB::table('students')->insert($students);
    }
}
