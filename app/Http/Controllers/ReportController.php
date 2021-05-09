<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreReport;

use App\Reports;
use App\AbuseTypes;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('throttle:6,1')->only('store');
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$reports = Reports::with('abuse_type')->orderBy('created_at','desc')->paginate(100);

		return view('pages.reports_index', compact('reports'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$abuseTypes = AbuseTypes::orderBy('order', 'asc')->get();

		return view('pages.reports_create', compact('abuseTypes'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreReport $request)
	{
		$report = new Reports;

		$report->address          = $request->input('address');
		$report->abuse_type_id    = $request->input('abuse_type_id');
		$report->abuse_type_other = $request->input('abuse_type_other');
		$report->abuser           = $request->input('abuser');
		$report->description      = $request->input('description');
		$report->contact_optin    = $request->has('contact_optin');
		$report->email            = $request->has('contact_optin') ? $request->input('email') : null;
		$report->phone            = $request->has('contact_optin') ? $request->input('phone') : null;

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

		$request->session()->flash('status', 'Report filed successfully.');

		return redirect("reports/{$report->address}");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $address
	 * @return \Illuminate\Http\Response
	 */
	public function show($address)
	{
		// Redirect, remove "*"
		if ($address !== str_replace('*', '', $address))
		{
			return redirect('/reports/' . str_replace('*', '', $address));
		}

		$reports = Reports::where('address','=',$address)->with('abuse_type')->orderBy('created_at','desc')->paginate(10);

		$found = ($reports->total() > 0);

		$first_date = Reports::select('created_at')->where('address','=',$address)->orderBy('created_at','desc')->first();

		$first_date = $first_date ? $first_date->created_at : null;

		return view('pages.reports_show', compact('address','reports','found','first_date'));
	}
}
