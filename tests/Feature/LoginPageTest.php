<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class LoginPageTest extends TestCase
{
    // can we login as a usual user?
    public function test_user_can_login_using_the_login_form()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/');
    }

    // can we get to the admin page if we a usual user?
    public function test_user_can_not_access_admin_page()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => '12345678',
        ]);

        $this->get('/admin/users');
        $response->assertRedirect('/');
    }
}
