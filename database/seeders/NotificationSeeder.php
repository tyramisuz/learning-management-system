<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Notification;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for( $i=0; $i<50; $i++){
            Notification::create([
                'user_id' => 2,
                'message' => 'you have a pending quiz to take',
                'group_name' => 'MKJ889',
                'is_read'=> false,
                'type' => 'quiz_reminder',
            ]);
        }
    }
}
