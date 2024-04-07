<?php

namespace Database\Seeders;

use App\Models\Books;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Books::truncate();

        $books = [
            // Thriller genre
            [
                'title' => 'The Girl with the Dragon Tattoo',
                'author' => 'Stieg Larsson',
                'description' => 'A gripping thriller that follows investigative journalist Mikael Blomkvist and hacker Lisbeth Salander as they uncover dark secrets.',
                'genre' => 'thriller',
                'image_path' => 'public/uploads/dragon.jpg',
            ],
            [
                'title' => 'Gone Girl',
                'author' => 'Gillian Flynn',
                'description' => 'A twisted and suspenseful story of a marriage gone terribly wrong, told from the perspectives of the husband and wife.',
                'genre' => 'thriller',
                'image_path' => 'public/uploads/gone.jpg',
            ],

            // Fiction genre
            [
                'title' => 'To Kill a Mockingbird',
                'author' => 'Harper Lee',
                'description' => 'A classic novel set in the American South during the 1930s, exploring themes of racial injustice, morality, and compassion.',
                'genre' => 'fiction',
                'image_path' => 'public/uploads/mocking.jpg',
            ],
            [
                'title' => '1984',
                'author' => 'George Orwell',
                'description' => 'A dystopian novel that examines the dangers of totalitarianism and the erosion of individual freedom and truth.',
                'genre' => 'fiction',
                'image_path' => 'public/uploads/1984.jpg',
            ],
        ];
        
        // Seed the database with the defined data
        foreach ($books as $book) {
            Books::create($book);
        }
    }
}
