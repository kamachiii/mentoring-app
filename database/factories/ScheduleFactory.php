<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
 */
class ScheduleFactory extends Factory
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
            'date' => $this->faker->date(),
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s'),
            'topic' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
        ];
    }

    /**
     * Indicate that the schedule is for a mentor.
     */
    public function forMentor(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => User::factory()->state(['role' => 'mentor']),
            ];
        });
    }
}
// namespace Database\Factories;

// use App\Models\User;
// use App\Models\MentoringGroup;
// use Illuminate\Database\Eloquent\Factories\Factory;

// /**
//  * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Schedule>
//  */
// class ScheduleFactory extends Factory
// {
//     /**
//      * Define the model's default state.
//      *
//      * @return array<string, mixed>
//      */
//     public function definition(): array
//     {
//         return [
//             'mentor_id' => User::factory()->create([
//                 'role' => 'mentor',
//             ])->id,
//             'mentoring_group_id' => random_int(1, MentoringGroup::count()),
//             'date' => $this->faker->date(),
//             'start_time' => $this->faker->time('H:i:s'),
//             'end_time' => $this->faker->time('H:i:s'),
//             'topic' => $this->faker->sentence(3),
//             'description' => $this->faker->optional()->paragraph(),
//         ];
//     }
// }
