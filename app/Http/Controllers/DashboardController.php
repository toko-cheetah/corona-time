<?php

namespace App\Http\Controllers;

use App\Models\CovidStatistic;
use Illuminate\View\View;

class DashboardController extends Controller
{
	public function showWorldwide(): View
	{
		$username = auth()->user()->username;
		$confirmed = CovidStatistic::sum('confirmed');
		$recovered = CovidStatistic::sum('recovered');
		$deaths = CovidStatistic::sum('deaths');

		return view('dashboard.worldwide', [
			'username'      => $username,
			'confirmed'     => number_format($confirmed),
			'recovered'     => number_format($recovered),
			'deaths'        => number_format($deaths),
		]);
	}

	public function showByCountry(): View
	{
		$username = auth()->user()->username;
		$covidStatisticsData = CovidStatistic::all();

		return view('dashboard.by-country', [
			'username'                   => $username,
			'covidStatisticsData'        => $covidStatisticsData,
		]);
	}
}
