<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Auth;
use Cache;
use Validator;
use Carbon\Carbon;

use App\Reports;
use App\AbuseTypes;
use App\Rules\BitcoinAddress;
use App\Http\Requests\StoreReportApi;


class ApiController extends Controller
{
	public function getDistinctReports(Request $request)
	{
		$page = $request->input('page', 1);

		$reverse = strtolower($request->input('reverse', false));
		$reverse = ($reverse && ($reverse == 'true' || $reverse == 1));

		if ($page < 1)
		{
			$page = 1;
		}

		$reports = Cache::remember("distinct_reports_{$page}_{$reverse}", Carbon::now()->addHour(1), function() use ($reverse) {
			return Reports::select(DB::raw('address, count(*) count, max(created_at) reported_at'))
						->groupBy('address')
						->orderBy('reported_at', ($reverse ? 'asc' : 'desc'))
						->simplePaginate(100);
		});

		return $reports;
	}

	/**
	 * This is largely the same as ReportController@store
	 */
	public function store(Request $request)
	{
		// Do validation
		$storeReportApi = new StoreReportApi;
		$storeReportApi->authorize();
		$response = ['response' => '', 'success' => false];
		$validator = Validator::make($request->all(), $storeReportApi->rules(), $storeReportApi->messages());
		if ($validator->fails())
		{
			$response['response'] = $validator->messages();
			return $response;
		}

		// Everything is valid...
		$report = new Reports;

		$report->address          = $request->input('address');
		$report->abuse_type_id    = $request->input('abuse_type_id');
		$report->abuse_type_other = $request->input('abuse_type_other');
		$report->abuser           = $request->input('abuser');
		$report->description      = $request->input('description');

		if (Auth::check())
		{
			$report->user_id = Auth::user()->id;
		}

		$report->from_ip = $request->ip();

		try
		{
			$report->from_host = gethostbyaddr($request->ip());
		}
		catch (\Exception $e)
		{
			$report->from_host = null;
		}

		// Get GeoIP data
		$location = geoip($request->ip());
		$report->from_country      = $location->country;
		$report->from_country_code = $location->iso_code;

		$report->save();

		$response['response'] = 'Report filed successfully.';
		$response['success'] = true;

		return $response;
	}

	public function abuseTypes()
	{
		return AbuseTypes::select('id','label')->get();
	}

	public function check(Request $request)
	{
		if (!$request->has('address')) {
			return [
				'error' => 'address is a required parameter'
			];
		}

		$count = Reports::whereAddress($request->input('address'))->count();
		$dates = Reports::whereAddress($request->input('address'))->selectRaw('min(created_at) first_seen, max(created_at) last_seen')->first();
		$recent = Reports::select(['abuse_type_id','abuse_type_other','description','created_at'])->whereAddress($request->input('address'))->latest()->limit(10)->get();

		return [
			'address' => $request->input('address'),
			'count' => $count,
			'first_seen' => $dates->first_seen,
			'last_seen' => $dates->last_seen,
			'recent' => $recent,
		];
	}

	public function download($time)
	{
		return $this->generateAndDownloadFile($time, false);
	}

	public function downloadFull($time)
	{
		return $this->generateAndDownloadFile($time, true);
	}

	private function generateAndDownloadFile($time, $full=false)
	{
		$filename = 'records_' .$time;
		if ($full) $filename .= '_full';
		$filename = "{$filename}.csv";
		$file = storage_path("backups/{$filename}");

		// sanitize time
		if (!in_array($time, ['1d', '30d', 'forever'])) {
			$time = '1d';
		}

		if (!file_exists($file)) {
			\Artisan::call("bitcoinabuse:export-reports", [
				'--since' => $time,
				'--full-dump' => !!$full
			]);
		}

		$headers = ['Cache-Control' => 'max-age=3600'];
		return \Response::download($file, $filename, $headers);
	}
}
