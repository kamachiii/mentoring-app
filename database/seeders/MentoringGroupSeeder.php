<?php

namespace Database\Seeders;

use App\Models\MentoringGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MentoringGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MentoringGroup::create([
            'name' => 'Group A',
        ]);
        MentoringGroup::create([
            'name' => 'Group B',
        ]);
        MentoringGroup::create([
            'name' => 'Group C',
        ]);
        MentoringGroup::create([
            'name' => 'Group D',
        ]);
        MentoringGroup::create([
            'name' => 'Group E',
        ]);
    }
}
