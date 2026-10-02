<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genres = [
            ['name' => 'Science'],
            ['name' => 'Mathematics'],
            ['name' => 'History'],
            ['name' => 'English'],
            // Add more genres as needed
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
