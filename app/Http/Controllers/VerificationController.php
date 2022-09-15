<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
	public function verify(EmailVerificationRequest $request): RedirectResponse
	{
		$request->fulfill();
		return redirect()->route('verification.verified');
	}

	public function resend(Request $request): RedirectResponse
	{
		$request->user()->sendEmailVerificationNotification();
		return back();
	}
}
