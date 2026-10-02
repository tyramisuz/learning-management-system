<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::create([
            'name' => 'Marikh 788',
            'description' => 'Every Tuesday',
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, 
            'color'=> '#baffc9',
        ]);

        Group::create([
            'name' => 'Neptune',
            'description' => '2pm-4pm',
            'user_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, 
            'color'=> '#ffb3ba',
        ]);
    }
}
