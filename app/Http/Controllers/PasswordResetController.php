<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordResetRequest;
use App\Http\Requests\PasswordUpdateRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
	public function send(PasswordResetRequest $request): RedirectResponse
	{
		$request->validated();
		$status = Password::sendResetLink(
			$request->only('email')
		);
		return $status === Password::RESET_LINK_SENT
			? redirect()->route('password.notice')->with(['status' => __($status)])
			: back()->withErrors(['email' => __($status)]);
	}

	public function reset(Request $request, $token): View
	{
		$email = $request->email;
		return view('auth.reset-password', ['token' => $token, 'email' => $email]);
	}

	public function update(PasswordUpdateRequest $request): RedirectResponse
	{
		$request->validated();
		$status = Password::reset(
			$request->only('email', 'password', 'password_confirmation', 'token'),
			function ($user, $password) {
				$user->forceFill([
					'password' => $password,
				])->setRememberToken(Str::random(60));

				$user->save();
				event(new PasswordReset($user));
			}
		);

		return $status === Password::PASSWORD_RESET
			? redirect()->route('password.verified')->with('status', __($status))
			: back()->withErrors('email', __($status));
	}
}
