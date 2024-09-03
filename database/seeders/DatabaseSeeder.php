<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\Question;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->state(new Sequence(
            ["role" => "user"],
            ["role" => "creator"]
        ))->create();

        User::factory()->create([
            'name' => 'quizmaster',
            'email' => 'quiz@example.com',
        ]);

        Question::factory(5)->create();
    }
}
