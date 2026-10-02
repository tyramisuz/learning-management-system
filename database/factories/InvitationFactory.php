<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Response;
use App\Models\Question;
use App\Models\User;
use App\Models\Quiz;
use App\Models\Group;
use App\Models\Invitation;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitation>
 */
class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Invitation::class;

    public function definition(): array
    {
       $senderId = User::inRandomOrder()->first()->id ?? User::factory()->create()->id;

        $receiver = User::inRandomOrder()->first() ?? User::factory()->create();

        return [
            'user_id' => $senderId,
            'group_id' => Group::inRandomOrder()->first()->id ?? Group::factory()->create()->id,
            'student_email' => $receiver->email, 
            'status' => $this->faker->randomElement(['pending', 'accept', 'reject']),
            'created_at' => now(),
            'updated_at' => now(),
            'student_id' => $receiver->id, 
            'deleted_at' => null,
        ];
    }
}
