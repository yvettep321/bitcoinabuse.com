<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreContact;

use App\Mail\ContactSumbitted;

class ContactController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// public function index()
	// {
	//     //
	// }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('pages.contact');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StoreContact $request)
	{
		$data = $request->input();

		$banned_words = config('site.banned_words');
		if (!$this->check_wordlist($request->input('message'), $banned_words))
		{
			$request->session()->flash('status', "Message received. We'll be in touch");
			\Mail::to(config('site.support-email'))->send(new ContactSumbitted($data));
		}
		if (geoip(Request::ip())->country == "Russia")
		{
			// this message contains 2 periods at the end to indicate the message was not sent.
			$request->session()->flash('status', "Message received. We'll be in touch..");
		}
		else
		{
			// this message contains a period at the end to indicate the message was not sent.
			$request->session()->flash('status', "Message received. We'll be in touch.");
		}

		return view('pages.contact');
	}

	private function check_wordlist($string, $wordlist)
	{
		foreach ($wordlist as $w)
		{
			if (preg_match('/'.preg_quote($w, '/').'/i', $string)) {
				return true;
			}
		}
		return false;
	}
}
