<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $uuids = json_decode(File::get(database_path('uuids.json')), true);

        $employee = [
            [
                'user_id' => $uuids[2],
                'emp_no' => '20243',
                'name' => 'Teacher',
                'email' => 'teacher@example.com',
                'contact' => '123456789',
                'department' => 'BSIT',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => $uuids[3],
                'emp_no' => '20244',
                'name' => 'Librarian',
                'email' => 'librarian@example.com',
                'contact' => '987654321',
                'department' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('employees')->insert($employee);
    }
}
