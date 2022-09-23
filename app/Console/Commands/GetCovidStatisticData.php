<?php

namespace App\Console\Commands;

use App\Models\CovidStatistic;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetCovidStatisticData extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'command:get-covid-statistics-data';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Get covid statistics data from API';

	/**
	 * Execute the console command.
	 *
	 * @return int
	 */
	public function handle()
	{
		$countries = Http::get('https://devtest.ge/countries')->collect();

		foreach ($countries as $country)
		{
			$countryStatistics = Http::post('https://devtest.ge/get-country-statistics', [
				'code' => $country['code'],
			])->collect();

			CovidStatistic::updateOrCreate(
				['id' => $countryStatistics['id']],
				[
					'country'   => $country['name'],
					'code'      => $countryStatistics['code'],
					'confirmed' => $countryStatistics['confirmed'],
					'deaths'    => $countryStatistics['deaths'],
					'recovered' => $countryStatistics['recovered'],
				]
			);
		}
	}
}
