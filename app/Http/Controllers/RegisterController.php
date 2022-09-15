<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;

class RegisterController extends Controller
{
	public function register(RegisterRequest $request): RedirectResponse
	{
		$user = User::create($request->validated());
		event(new Registered($user));
		auth()->login($user);
		return redirect()->route('verification.notice');
	}
}
