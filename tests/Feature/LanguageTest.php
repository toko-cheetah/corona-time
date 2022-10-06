<?php

namespace Tests\Feature;

use Tests\TestCase;

class LanguageTest extends TestCase
{
	public function test_user_can_change_language_to_georgian()
	{
		$response = $this->get(route('locale.change', 'ka'));
		$response->assertSessionHas('lang', 'ka');
	}

	public function test_app_has_only_english_and_georgian_languages()
	{
		$response = $this->get(route('locale.change', 'de'));
		$response->assertSessionHas('lang', 'en');
	}
}
