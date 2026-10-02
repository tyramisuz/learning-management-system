<?php

namespace Database\Factories;

use App\Models\Response;
use App\Models\Question;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition()
    {
        return [
            'name' => $this->faker->words(2,true),
            'description' => $this->faker->sentence,
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id; // Example of creating a related user
            },
            'quiz_id' => function () {
                return \App\Models\Quiz::factory()->create()->id; // Example of creating a related genre
            },
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null, // Assuming it's soft delete column
            'color'=> $this->faker->hexColor,
        ];
    }
}
