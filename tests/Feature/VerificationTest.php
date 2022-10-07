<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class VerificationTest extends TestCase
{
	use RefreshDatabase;

	private User $user;

	protected function setUp(): void
	{
		parent::setUp();
		$this->user = User::factory()->create(['email_verified_at' => null]);
	}

	public function test_user_has_verified_email()
	{
		$verificationUrl = URL::temporarySignedRoute(
			'verification.verify',
			now()->addMinutes(60),
			['id' => $this->user->id, 'hash' => sha1($this->user->email)]
		);

		$response = $this->actingAs($this->user)->get($verificationUrl);

		$this->assertNotNull($this->user->email_verified_at);

		$response->assertRedirect(route('verification.verified'));
	}

	public function test_user_received_verification_email()
	{
		Notification::fake();

		$this->actingAs($this->user)->post(route('verification.send'));

		Notification::assertSentTo($this->user, VerifyEmail::class);
	}
}
