<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Genre;

class QuizFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quiz::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'dueDate' => $this->faker->dateTimeBetween('+1 week', '+2 months'),
            'desc' => $this->faker->paragraph(),
            'visibility' => $this->faker->randomElement(['public', 'private']),
            'duration' => $this->faker->numberBetween(30, 120), 
            'status' => $this->faker->randomElement(['draft', 'publish']),
            'publish_date' => $this->faker->dateTimeThisMonth(),
            'passgrade' => $this->faker->numberBetween(50, 100) . '%', 
            'participants' => $this->faker->numberBetween(10, 100), 
            'user_id' => User::factory()->create()->id, 
            'permission' => $this->faker->randomElement(['Yes', 'No']),
            'icon' => $this->faker->imageUrl(100, 100, 'icon'),
            'genre_id' => Genre::inRandomOrder()->first()->id, 
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
