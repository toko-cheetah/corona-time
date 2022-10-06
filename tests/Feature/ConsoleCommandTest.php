<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConsoleCommandTest extends TestCase
{
	use RefreshDatabase;

	public function test_console_command_get_covid_statistics_data_works()
	{
		$this->artisan('command:get-covid-statistics-data')->assertExitCode(0);
	}
}
