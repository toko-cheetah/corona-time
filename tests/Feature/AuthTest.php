<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
	use RefreshDatabase;

	private User $user;

	protected function setUp(): void
	{
		parent::setUp();
		$this->user = User::factory()->create();
	}

	public function test_register_input_fields_are_required()
	{
		$response = $this->post(route('register'));
		$response->assertSessionHasErrors(['username', 'email', 'password']);
	}

	public function test_register_username_and_password_contain_min_3_symbols()
	{
		$response = $this->post(route('register'), [
			'username' => 'jo',
			'password' => 'jo',
		]);
		$response->assertSessionHasErrors([
			'username' => 'The username must be at least 3 characters.',
			'password' => 'The password must be at least 3 characters.',
		]);
	}

	public function test_register_username_and_email_are_unique()
	{
		$response = $this->post(route('register'), [
			'username' => $this->user->username,
			'email'    => $this->user->email,
		]);
		$response->assertSessionHasErrors([
			'username' => 'The username has already been taken.',
			'email'    => 'The email has already been taken.',
		]);
	}

	public function test_register_repeat_password_is_same_as_password()
	{
		$response = $this->post(route('register'), [
			'password'              => 'joe',
			'password_confirmation' => 'joee',
		]);
		$response->assertSessionHasErrors(['password' => 'The password confirmation does not match.']);
	}

	public function test_sign_up_button_redirects_to_verification_notice_page()
	{
		$response = $this->post(route('register'), [
			'username'              => 'joe',
			'email'                 => 'joe@mail.com',
			'password'              => 'joe',
			'password_confirmation' => 'joe',
		]);
		$response->assertRedirect(route('verification.notice'));
	}

	public function test_login_input_fields_are_required()
	{
		$response = $this->post(route('login'));
		$response->assertSessionHasErrors(['username', 'password']);
	}

	public function test_user_can_login_with_username()
	{
		User::factory()->create([
			'username' => 'saba',
			'password' => 'saba',
		]);
		$response = $this->post(route('login'), [
			'username' => 'saba',
			'password' => 'saba',
		]);
		$response->assertRedirect(route('home'));
		$this->assertAuthenticated();
	}

	public function test_user_can_login_with_email()
	{
		$response = $this->post(route('login'), [
			'username' => $this->user->email,
			'password' => $this->user->password,
		]);
		$response->assertRedirect(route('home'));
	}

	public function test_not_registered_user_tries_to_login()
	{
		$response = $this->post(route('login'), [
			'username' => 'sasha',
			'password' => 'sasha',
		]);
		$response->assertSessionHasErrors(['username' => __('auth.failed')]);
	}

	public function test_user_can_remember_device_when_login()
	{
		$response = $this->actingAs($this->user)->post(route('login'), [
			'username' => $this->user->username,
			'password' => $this->user->password,
			'remember' => '1',
		]);
		$response->assertRedirect(route('home'));
		$this->assertAuthenticatedAs($this->user);
	}

	public function test_user_can_logout()
	{
		$response = $this->actingAs($this->user)->post(route('logout'));
		$response->assertRedirect(route('login.page'));
	}
}
