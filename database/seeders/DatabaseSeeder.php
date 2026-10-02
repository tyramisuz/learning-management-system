<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // User::factory(10)->create();
       

        $this->call([
            AnnouncementSeeder::class,
            GenreSeeder::class,
            GroupSeeder::class,
            InvitationSeeder::class,
            NotificationSeeder::class,
            ParticipantSeeder::class,
            QuizSeeder::class,
            UserSeeder::class,
            // Other seeders can be added here
        ]);
    }
}
