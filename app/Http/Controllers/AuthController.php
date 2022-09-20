<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function register(RegisterRequest $request): RedirectResponse
	{
		$user = User::create($request->validated());
		event(new Registered($user));
		auth()->login($user);
		return redirect()->route('verification.notice');
	}

	public function login(LoginRequest $request): RedirectResponse
	{
		$logintype = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		if (auth()->attempt([
			$logintype => $request->username,
			'password' => $request->password,
		]))
		{
			$request->session()->regenerate();
			return redirect()->route('home');
		}
		return back()->withErrors(['username' => __('auth.failed')]);
	}

	public function logout(Request $request): RedirectResponse
	{
		auth()->logout();
		$request->session()->invalidate();
		$request->session()->regenerateToken();
		return redirect()->route('login.page');
	}
}
