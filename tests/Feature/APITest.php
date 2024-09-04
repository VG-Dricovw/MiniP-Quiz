<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class APITest extends TestCase
{
    use RefreshDatabase;
    protected $seed = true;
    /**
     * A basic feature test example.
     */
    public function test_api_login(): void
    {
        $response = $this->postJson('/api/auth/login', ["email" => "quiz@example.com", "password" => "quiz"]);
        $response->assertStatus(200);
    }

    public function getToken(string $email = "quiz@example.com", string $password = "quiz")
    {
        $response = $this->postJson('/api/auth/login', ["email" => $email, "password" => $password]);
        return json_decode($response->getContent())->access_token;
    }

    public function test_api_need_token(): void
    {
        $response = $this->getJson('api/users');
        $response->assertSee('not authorized');
        $response->assertUnauthorized();
    }

    public function test_api_user_index(): void
    {
        $token = $this->getToken();
        // dump($token);
        $response = $this->withHeader("Authorization", "Bearer " . $token)->getJson('api/users');
        $response->assertStatus(200);

    }

    public function test_api_user_show(): void
    {
        $token = $this->getToken();
        // dump($token);
        $response = $this->withHeader("Authorization", "Bearer " . $token)->getJson('api/users/11');
        $response->assertStatus(200);

    }

    public function test_api_user_store(): void
    {
        $token = $this->getToken();
        $response = $this->withHeader("Authorization", "Bearer " . $token)->postJson('api/users', ['email' => 'drico@vg.com', 'password' => 'vg', 'name' => 'drico']);
        $response->assertCreated();

    }

    public function test_api_user_update(): void
    {
        $token = $this->getToken();
        $response = $this->withHeader("Authorization", "Bearer " . $token)->patchJson('api/users/11', ['email' => 'riddler@quizmaster.com']);

        $response->assertStatus(200);

    }

    public function test_api_user_delete(): void
    {
        $token = $this->getToken();
        $response = $this->withHeader("Authorization", "Bearer " . $token)->deleteJson('api/users/11');

        $response->assertStatus(202);
    }

    public function test_api_quiz_index(): void
    {
        $token = $this->getToken();
        // dump($token);
        $response = $this->withHeader("Authorization", "Bearer " . $token)->getJson('api/quiz');
        $response->assertStatus(200);

    }

    public function test_api_quiz_show(): void
    {
        $token = $this->getToken();
        // dump($token);
        $response = $this->withHeader("Authorization", "Bearer " . $token)->getJson('api/quiz/2');
        $response->assertStatus(200);

    }

    public function test_api_quiz_store(): void
    {
        $token = $this->getToken();
        $response = $this->withHeader("Authorization", "Bearer " . $token)->postJson('api/quiz', ['chapter' => 2, 'question' => "why does a gambler sleep on the floor?", 'answer' => 'He lost the bet']);

        // dump($this->preventDuplicate);
        $response->assertCreated();

    }

    public function test_api_quiz_update(): void
    {
        $token = $this->getToken();
        $response = $this->withHeader("Authorization", "Bearer " . $token)->patchJson('api/quiz/1', ['chapter' => 1, 'question' => "Why does an engineer need glasses", 'answer' => 'Otherwise he would be an Engi-far']);

        $response->assertStatus(200);

    }

    public function test_api_quiz_delete(): void
    {
        $token = $this->getToken();
        $response = $this->withHeader("Authorization", "Bearer " . $token)->deleteJson('api/quiz/3');

        $response->assertStatus(202);
    }
}
