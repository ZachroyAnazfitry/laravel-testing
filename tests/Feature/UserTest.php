<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    // public function test_example()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    // check whether when login redirect to dashboard is successful
    public function test_login_redirect_to_dashboard_succesfully()
    {
        // initiate data
        User::factory()->create([
            'email' => 'test@example.com',
            'password' => bcrypt('test'),
        ]);

        // insert temporary data in this variable
        $response_login = $this->post('/login', [
            'email' => 'test@example.com',
            'password' => 'test',
        ]);

        // give response
        $response_login->assertStatus(302);
        $response_login->assertRedirect('/dashboard');
    }

    // test whether user can access dashboard
    public function test_auth_user_can_access_dashboard(){

        // initiate data
        $user = User::factory()->create();

        $user_response = $this->actingAs($user)->get('/dashboard');
        $user_response->assertStatus(200);
    }

    // test for unauthorized user cannot acces dashboard
    public function test_unauth_user_cannot_access_dashboard()
    {
        $response = $this->get('/dashboard');
        $response->assertStatus(302);  
        $response->assertRedirect('/login');
    }
}
