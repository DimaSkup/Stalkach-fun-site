<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\FakeUsersSeeds;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRoutesTest extends TestCase
{
	use RefreshDatabase;

	// ----------------------------------------------------------------- //
	//
	//                          TESTS
	//
	// ----------------------------------------------------------------- //

	// assert that we can reach any user's page
	public function test_user_get_user_page(): void
	{
		$this->seed(FakeUsersSeeds::class);
		$randomUser = User::inRandomOrder()->take(1)->first();

		$response = $this->get(route('user.show', ['user' => $randomUser->id]));
		$response->assertStatus(200);
	}

	// if some user is authorized he can get only it's own edit page
	// but can't get an edit page of the other users;
	public function test_user_get_user_edit_page(): void
	{
		$this->seed(FakeUsersSeeds::class);
		$anotherUserId = User::inRandomOrder()->take(1)->first();
		$ourUserId = $this->executeLogin();      // first of all we need to log in

		// get own edit page
		$response = $this->get(route('user.edit', ['user' => $ourUserId]));
		$response->assertStatus(200);

		// get others edit page
		$response = $this->get(route('user.edit', ['user' => $anotherUserId]));
		$response->assertUnauthorized();

		$this->get('/logout');      // after the test we need to log out
	}







	// ----------------------------------------------------------------- //
	//
	//                        HELPERS
	//
	// ----------------------------------------------------------------- //


	// this function executes the login process because
	// in another case we can't do some actions;
	// returns the user's id which has just logged in
	private function executeLogin(): int
	{
		$testUser = User::factory()->create();

		$this->post('/login', [
			'email'     => $testUser->email,
			'password'  => '12345678',
		]);

		return $testUser->id;
	}
}
