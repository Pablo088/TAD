<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(100)->create();
         
        \App\Models\Career::factory(5)->create();
        \App\Models\Student::factory(50)->create();
        \App\Models\StudentCareer::factory(50)->create();
        \App\Models\StudentAssist::factory(50)->create();
        \App\Models\Setting::factory(1)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
