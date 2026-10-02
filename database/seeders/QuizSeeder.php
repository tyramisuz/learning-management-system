<?php

// database/seeders/QuizSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        Quiz::create([
            'title' => 'Grafity Teory',
            'dueDate' => '2024-12-24',
            'desc' => 'Learn about grafity....',
            'visibility' => 'public',
            'duration' => 120, 
            'status' => 'publish',
            'publish_date' => now(),
            'passgrade' => '40%', 
            'participants' => null, 
            'user_id' => 2, 
            'permission' => 'Yes',
            'icon' => null,
            'genre_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        Quiz::create([
            'title' => 'Index Chapter 5',
            'dueDate' => '2024-08-27',
            'desc' => 'Index is easy',
            'visibility' => 'public',
            'duration' => 40, 
            'status' => 'draft',
            'publish_date' => now(),
            'passgrade' => '40%', 
            'participants' => null, 
            'user_id' => 2, 
            'permission' => 'Yes',
            'icon' => null,
            'genre_id' => 2, 
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);
    }
}
