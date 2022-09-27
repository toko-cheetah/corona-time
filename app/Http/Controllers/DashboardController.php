<?php

namespace App\Http\Controllers;

use App\Models\CovidStatistic;
use Illuminate\Http\Request;
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

	public function showByCountry(Request $request): View
	{
		$username = auth()->user()->username;

		$ascending = collect([
			'country'   => $request->sortBy === 'country' ? $request->ascending : 0,
			'confirmed' => $request->sortBy === 'confirmed' ? $request->ascending : 0,
			'deaths'    => $request->sortBy === 'deaths' ? $request->ascending : 0,
			'recovered' => $request->sortBy === 'recovered' ? $request->ascending : 0,
		]);

		$request->sortBy
			? ($request->ascending % 2 !== 0
				? $covidStatisticsData = CovidStatistic::all()->sortBy($request->sortBy)
				: $covidStatisticsData = CovidStatistic::all()->sortByDesc($request->sortBy))
			: $covidStatisticsData = CovidStatistic::all();

		return view('dashboard.by-country', [
			'username'                   => $username,
			'covidStatisticsData'        => $covidStatisticsData,
			'ascending'                  => $ascending,
		]);
	}
}
