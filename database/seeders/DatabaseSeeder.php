<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;     
use App\Models\Schedule;  
use App\Models\Presence;  
use Illuminate\Support\Facades\Hash; 
use Faker\Factory as Faker; 
use Database\Seeders\MaterialSeeder; 
use Database\Seeders\DiscussionSeeder; 
use Database\Seeders\CommentSeeder; 


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); 

        $this->call(UserSeeder::class);

        $mentor = User::where('email', 'mentor@example.com')->first();
        if (!$mentor) {
            $mentor = User::create([
                'name' => 'Rafly Fadhilah', 
                'email' => 'mentor@example.com',
                'password' => Hash::make('mentor123'), 
                'role' => 'mentor',
                'email_verified_at' => now(),
            ]);
            $this->command->info('Mentor "Rafly Fadhilah" dibuat.');
        }
        $currentMentorId = $mentor->id; 

        
        $students = User::where('role', 'user')->limit(10)->get(); 
        if ($students->isEmpty()) {
            User::factory()->count(10)->state(['role' => 'user'])->create();
            $students = User::where('role', 'user')->limit(10)->get(); 
            $this->command->info('Siswa default dibuat.');
        }

        if ($students->isEmpty()) { 
            $this->command->info('Tidak ada siswa tersedia untuk pembagian. Seeding presensi dilewati.');
            return;
        }

        
        Schedule::where('user_id', $currentMentorId)
                ->whereRaw('DATE(date) = ?', [now()->toDateString()]) 
                ->delete();

        $todaySchedule = Schedule::firstOrCreate(
            [
                'user_id' => $currentMentorId,
                'date' => now()->toDateString(),
            ],
            [
                'start_time' => '09:00:00',
                'end_time' => '10:00:00',
                'topic' => 'Sesi Mentoring Harian - ' . now()->translatedFormat('d F Y'),
                'description' => 'Jadwal otomatis dibuat oleh seeder untuk presensi.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        if (!$todaySchedule) {
            $this->command->error('Gagal membuat atau mendapatkan jadwal untuk mentor. Seeding presensi dilewati.');
            return;
        }

        foreach ($students as $student) {
            Presence::updateOrCreate(
                [
                    'user_id' => $student->id,
                    'schedule_id' => $todaySchedule->id,
                ],
                [
                    'status' => $faker->randomElement(['present', 'absent', 'sick', 'permit']), // Menggunakan $faker
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        $this->command->info('Data mentor, siswa, jadwal, dan presensi awal telah dibuat.');

        $this->call([
            // MaterialSeeder::class, 
            // DiscussionSeeder::class,
            // CommentSeeder::class
        ]);
    }
}

// namespace Database\Seeders;

// use App\Models\User;
// // use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class DatabaseSeeder extends Seeder
// {
//     /**
//      * Seed the application's database.
//      */
//     public function run(): void
//     {
//         $this->call([
//             MentoringGroupSeeder::class,
//             UserSeeder::class,
//             ScheduleSeeder::class,
//             MaterialSeeder::class,
//             PresenceSeeder::class,
//             DiscussionSeeder::class,
//             CommentSeeder::class
//         ]);
//     }
// }
