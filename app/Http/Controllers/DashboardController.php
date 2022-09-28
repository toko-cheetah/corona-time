<?php

namespace App\Http\Controllers;

use App\Models\CovidStatistic;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

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

		$countClicks = collect([
			'country'   => $request->sortBy === 'country' ? $request->countClicks : 0,
			'confirmed' => $request->sortBy === 'confirmed' ? $request->countClicks : 0,
			'deaths'    => $request->sortBy === 'deaths' ? $request->countClicks : 0,
			'recovered' => $request->sortBy === 'recovered' ? $request->countClicks : 0,
		]);

		$countryArray = collect([]);

		foreach (CovidStatistic::all() as $country)
		{
			Str::contains(
				Str::remove(' ', strtolower($country->country)),
				preg_replace('/\s|\./mi', '', strtolower($request->search))
			)
				&& $countryArray->push($country->country);
		}

		$request->search
			? $covidStatisticsData = CovidStatistic::all()->whereIn('country', $countryArray)
			: ($request->sortBy
				? ($request->countClicks % 2 !== 0
					? $covidStatisticsData = CovidStatistic::all()->sortBy($request->sortBy)
					: $covidStatisticsData = CovidStatistic::all()->sortByDesc($request->sortBy))
				: $covidStatisticsData = CovidStatistic::all());

		return view('dashboard.by-country', [
			'username'              => $username,
			'covidStatisticsData'   => $covidStatisticsData,
			'countClicks'           => $countClicks,
			'searchValue'           => $request->search,
		]);
	}
}
