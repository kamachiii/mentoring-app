<?php

namespace Database\Seeders;

use App\Models\Presence;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PresenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Presence::factory()->count(10)->create();
    }
}
