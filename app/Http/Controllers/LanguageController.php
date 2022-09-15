<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;

class LanguageController extends Controller
{
	public function change(string $locale): RedirectResponse
	{
		in_array($locale, config('app.available_locales'))
			? session()->put('lang', $locale)
			: session()->put('lang', 'en');

		return back();
	}
}
