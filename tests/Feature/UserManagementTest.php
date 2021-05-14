<?php

namespace Tests\Feature;

use Carbon\Factory as CarbonFactory;
use Faker\Factory as FakerFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use App\Models\search;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_a_login_form()
    {
        $response = $this->get('/login');

        $response->assertSuccessful();
        $response->assertViewIs('auth.login');
    }

    public function test_user_cannot_view_a_login_form_when_authenticated()
    {
        $user = User::factory()->create();
        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);
        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('home'));
    }

    public function test_insert_into_search_table()
    {
        $serach = search::create([
            'user_id' => "1",
            'searched_text' => "ali1"
        ]);

        $this->assertNotEmpty($serach);
    }


    public function test_search_ajax()
    {
        $user = User::factory()->create();

        $data = [
            "searched_text" => "fire"
        ];

        $response = $this->actingAs($user)->post('/search-ajax', $data);
        $response->assertStatus(200);
    }
}
