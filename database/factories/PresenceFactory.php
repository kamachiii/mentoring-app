<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Schedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
 */
class PresenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory()->state(['role' => 'user']),
            'schedule_id' => Schedule::factory()->forMentor(), 
            'status' => $this->faker->randomElement(['present', 'absent', 'sick', 'permit']),
        ];
    }
}

// namespace Database\Factories;

// use App\Models\User;
// use App\Models\Schedule;
// use Illuminate\Database\Eloquent\Factories\Factory;

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presence>
//  */
// class PresenceFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         return [
//             'user_id' => User::factory(),
//             'schedule_id' => Schedule::factory(),
//             'status' => $this->faker->randomElement(['present', 'absent', 'sick', 'permit']),
//         ];
//     }
// }
