<?php

namespace App\Http\Controllers;

use App\Models\CovidStatistic;
use Illuminate\View\View;

class DashboardController extends Controller
{
	public function showWorldwide(): View
	{
		$user = auth()->user()->username;
		$covidStatisticsData = CovidStatistic::all();
		$confirmed = collect($covidStatisticsData)->sum('confirmed');
		$recovered = collect($covidStatisticsData)->sum('recovered');
		$deaths = collect($covidStatisticsData)->sum('deaths');

		return view('dashboard.worldwide', [
			'user'      => $user,
			'confirmed' => number_format($confirmed),
			'recovered' => number_format($recovered),
			'deaths'    => number_format($deaths),
		]);
	}

	public function showByCountry(): View
	{
		$user = auth()->user()->username;
		$covidStatisticsData = CovidStatistic::all();

		return view('dashboard.by-country', [
			'user'                   => $user,
			'covidStatisticsData'    => $covidStatisticsData,
		]);
	}
}
