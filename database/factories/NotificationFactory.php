<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Response;
use App\Models\Question;
use App\Models\Notification;
use App\Models\Invitation;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Group;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = Notification::class;

    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
            'invitation_id' => Invitation::inRandomOrder()->first()->id ?? Invitation::factory()->create()->id,
            'message' => $this->faker->sentence,
            'group_name' => $this->faker->company,
            'created_at' => now(),
            'updated_at' => now(),
            'is_read' => $this->faker->boolean,
            'deleted_at' => null,
            'type' => $this->faker->randomElement(['invite', 'new_quiz', 'assign_quiz', 'new_member', 'accept', 'reject']),
            'sender_id' => User::inRandomOrder()->first()->id ?? User::factory()->create()->id,
        ];
    }
}
