<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schedule::factory()->count(5)->forMentor()->create();

        $mentor = \App\Models\User::where('email', 'mentor@example.com')->first();
        if ($mentor) {
            Schedule::factory()->count(3)->create([
                'user_id' => $mentor->id,
                'date' => now()->toDateString(), 
            ]);
        }
    }
}

// namespace Database\Seeders;

// use App\Models\Schedule;
// use Illuminate\Database\Seeder;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

// class ScheduleSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         Schedule::factory()->count(8)->create();
//     }
// }
