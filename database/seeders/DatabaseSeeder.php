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
            'role' => 'admin',
            'password' => 'quiz'
        ]);

        $data = [
            [
                "question" => "Why does a gambler sleep on the floor?",
                "answer" => "lost the bet"   
            ],
            [
                "question" => "How does Santa make the presents?",
                "answer" => "red"   
            ],
            [
                "question" => "How many germans does it take to change a lightbulb?",
                "answer" => "9"   
            ],
            [
                "question" => "How many people can stand on the back of a politician?",
                "answer" => "0"   
            ],
        ];
        foreach ($data as $value) {
        Question::factory()->create($value);
        }
    }
}
