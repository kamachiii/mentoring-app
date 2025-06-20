<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Discussion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'discussion_id' => Discussion::factory(),
            'content' => $this->faker->paragraph,
        ];
    }
}
