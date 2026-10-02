<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->superAdmin()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
        ]);

        User::create([
            'name' => 'isha',
            'image' => null,
            'gender' =>'female',
            'dateOfBirth' => null,
            'school' => null,
            'email' => 'isha@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('DemoPassword123!'),
            'role' => 'user',
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ]);

        // Create normal users
        User::factory()->count(3)->normalUser()->create();
    }
}
