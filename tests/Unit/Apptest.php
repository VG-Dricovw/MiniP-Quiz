<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;

class AppTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_app_login(): void
    {

        $view = $this->get('login');

        $view->assertSee('Log in to your account');
    }

    public function test_app_(): void
    {

    }
}
