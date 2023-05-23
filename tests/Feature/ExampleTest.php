<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        // trying to use other assertion methods
        $response->assertSee('Documentation');  // if write Documentations, it will failed
        
        // checking html contents in order, if not in order, test failed
        $response->assertSeeInOrder(['Documentation', 'Laracast']);

        $response->assertStatus(200);
    }

    // create a new test
    public function test_the_about_route_returns_a_successful_response()
    {
        $response = $this->get('/about');

        // checking html contents
        // $response->assertSee('about');  // test will failed
        $response->assertSee('About');  // test will success

        $response->assertStatus(200);
    }
}
