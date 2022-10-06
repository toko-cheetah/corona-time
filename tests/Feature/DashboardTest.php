<?php

namespace Tests\Feature;

use App\Models\CovidStatistic;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
	use RefreshDatabase;

	private User $user;

	protected function setUp(): void
	{
		parent::setUp();
		$this->user = User::factory()->create();
	}

	public function test_home_page_worldwide_section_exists()
	{
		$response = $this->actingAs($this->user)->get(route('home'));
		$response->assertSee([
			__('dashboard.worldwide'),
			__('dashboard.new_cases'),
			__('dashboard.recovered'),
			__('dashboard.death'),
		]);
	}

	public function test_home_page_by_country_section_exists()
	{
		$response = $this->actingAs($this->user)->get(route('home.by_country'));
		$response->assertSee([
			__('dashboard.by_country'),
			__('dashboard.location'),
			__('dashboard.new_cases'),
			__('dashboard.recovered'),
			__('dashboard.death'),
		]);
	}

	public function test_user_can_search_data_by_country()
	{
		CovidStatistic::create([
			'country'   => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'confirmed' => 100,
			'deaths'    => 100,
			'recovered' => 100,
		]);

		$response = $this->actingAs($this->user)->get('/by-country?search=geo');

		$response->assertSee('Georgia');
		$response->assertOk();
	}

	public function test_user_can_sort_data_by_parameters()
	{
		CovidStatistic::create([
			'country'   => ['en' => 'Georgia', 'ka' => 'საქართველო'],
			'code'      => 'GE',
			'confirmed' => 100,
			'deaths'    => 100,
			'recovered' => 100,
		]);

		$response = $this->actingAs($this->user)->get('/by-country?sortBy=country&countClicks=1');

		$response->assertOk();
	}
}
