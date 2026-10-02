<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Announcement;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Announcement::create([
            'title' => null,
            'message' => 'Hyeee everyone!!, how uu guys doin?',
            'type'=>'manual',
            'created_by'=>3,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'group_id' => 18,
        ]);

        Announcement::create([
            'title' => null,
            'message' => 'Dont forget to answer my quiz ya',
            'type'=>'manual',
            'created_by'=>3,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'group_id' => 18,
        ]);

        Announcement::create([
            'title' => 'Nia Morar',
            'message' => 'has assign a quiz',
            'type'=>'assign_quiz',
            'created_by'=> null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'group_id'=>18,
        ]);

        Announcement::create([
            'title' => 'Athirah',
            'message' => 'has completed a quiz',
            'type'=>'complete_quiz',
            'created_by'=> null,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
            'group_id'=>18,
        ]);

    }
}
