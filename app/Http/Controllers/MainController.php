<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Cache;
use App\Reports;
use DB;

class MainController extends Controller
{
	public function home()
	{
		$dayCount = Cache::remember('dayCount', Carbon::now()->addHour(), function() {
			return Reports::where('created_at', '>', Carbon::now()->subDay())->count();
		});
		$weekCount = Cache::remember('weekCount', Carbon::now()->addHour(), function() {
			return Reports::where('created_at', '>', Carbon::now()->subWeek())->count();
		});
		$monthCount = Cache::remember('monthCount', Carbon::now()->addHour(), function() {
			return Reports::where('created_at', '>', Carbon::now()->subMonth())->count();
		});
		// dd($dayCount, $weekCount, $monthCount);

		$yearsGraph = Cache::remember('yearsGraph', Carbon::now()->addDay(), function() {
			return Reports::select(DB::raw('COUNT(*) count, YEAR(created_at) year'))
					->groupBy('year')
					->get()->map(function($item) {
						$item->label = $item->year;
						return $item;
					});
		});
		$monthsGraph = Cache::remember('monthsGraph', Carbon::now()->addDay(), function() {
			return Reports::select(DB::raw('COUNT(*) count, MONTH(created_at) month, YEAR(created_at) year'))
					->groupBy('year', 'month')
					->where('created_at', '>', now()->subMonths(12))
					->get()->map(function($item) {
						$item->label = date('M', mktime(0, 0, 0, $item->month, 10)) . ' ' . $item->year;
						return $item;
					});
		});

		$daysGraph = Cache::remember('daysGraph', Carbon::now()->addHour(), function() {
			return Reports::select(DB::raw('COUNT(*) count, DAY(created_at) day, MONTH(created_at) month, YEAR(created_at) year'))
					->groupBy('year', 'month', 'day')
					->where('created_at', '>', now()->subDays(30))
					->get()->map(function($item) {
						$item->label = date('M', mktime(0, 0, 0, $item->month, 10)) . ' ' . $item->day . ', ' . $item->year;
						return $item;
					});
		});

		// dd($yearsGraph);
		// dd($monthsGraph);
		// dd($daysGraph);

		$reports = Reports::with('abuse_type')->orderBy('created_at','desc')->paginate(9);

		return view('pages.home', compact('dayCount', 'weekCount', 'monthCount', 'yearsGraph', 'monthsGraph', 'daysGraph', 'reports'));
	}
}
