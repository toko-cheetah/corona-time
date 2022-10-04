<?php

namespace Tests\Feature;

use App\Models\User;
use App\Notifications\PasswordResetNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class PasswordResetTest extends TestCase
{
	use RefreshDatabase;

	private User $user;

	protected function setUp(): void
	{
		parent::setUp();
		$this->user = User::factory()->create();
	}

	public function test_user_received_password_reset_email()
	{
		Notification::fake();

		$this->post(route('password.send'), ['email' => $this->user->email]);

		Notification::assertSentTo($this->user, PasswordResetNotification::class);
	}

	public function test_password_reset_notification_contains_reset_button()
	{
		$notification = new PasswordResetNotification(Password::createToken($this->user));

		$rendered = $notification->toMail($this->user)->render();

		$this->assertStringContainsString(__('mail-message.recover_password'), $rendered);
	}

	public function test_user_can_reset_password()
	{
		$response = $this->get(route('password.reset', ['token' => Password::createToken($this->user)]));

		$response->assertSuccessful(route('password.update'));
	}

	public function test_user_updated_password()
	{
		$response = $this->post(route('password.update', [
			'token'                 => Password::createToken($this->user),
			'email'                 => $this->user->email,
			'password'              => 'newPassword',
			'password_confirmation' => 'newPassword',
		]));

		$response->assertRedirect(route('password.verified'));
	}
}
