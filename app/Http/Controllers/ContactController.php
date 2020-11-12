<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\StoreContact;

use App\Mail\ContactSubmitted;

class ContactController extends Controller
{
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
		$banned_countries = config('site.banned_countries');
		if ($this->check_wordlist($request->input('message'), $banned_words) || $this->check_wordlist(geoip($request->ip())->country, $banned_countries))
		{
			// this message contains a period at the end to indicate the message was not sent.
			$request->session()->flash('status', "Message received. We'll be in touch.");
		}
		else
		{
			$request->session()->flash('status', "Message received. We'll be in touch");
			\Mail::to(config('site.support-email'))->send(new ContactSubmitted($data));
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
