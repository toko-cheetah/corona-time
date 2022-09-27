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

	private $ascending;

	public function __construct()
	{
		$this->ascending = collect([
			'country'   => 0,
			'confirmed' => 0,
			'deaths'    => 0,
			'recovered' => 0,
		]);
	}

	public function showByCountry(Request $request): View
	{
		$username = auth()->user()->username;

		$sortBy = $request->sortBy;
		$sortBy && $this->ascending[$sortBy] = $request->ascending;

		$sortBy
			? ($this->ascending[$sortBy] % 2 !== 0
				? $covidStatisticsData = CovidStatistic::all()->sortBy($sortBy)
				: $covidStatisticsData = CovidStatistic::all()->sortByDesc($sortBy))
			: $covidStatisticsData = CovidStatistic::all();

		return view('dashboard.by-country', [
			'username'                   => $username,
			'covidStatisticsData'        => $covidStatisticsData,
			'ascending'                  => $this->ascending,
		]);
	}
}
