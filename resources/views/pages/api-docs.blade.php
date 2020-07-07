{{------------------------------------------}}
{{--PAGE CONFIG --}}
{{------------------------------------------}}

@extends('layouts.default')

@section('seo-meta')
<title>API Documentation | BitcoinAbuse.com </title>
<meta name=Description content="API Documentation for BitcoinAbuse.com. Lookup bitcoin addresses that have been linked to criminal activity."/>
@stop

{{------------------------------------------}}
{{--CONTENT --}}
{{------------------------------------------}}

@section('content')

<main role="main">
	<div class="jumbotron">
		<div class="container text-center">
			<h1 class="display-4">API Documentation</h1>
			<p>Lookup bitcoin addresses that have been linked to criminal activity</p>
		</div>
	</div>

	<div class="container">
		<h3>Endpoints</h3>
		<ul>
			<li><a href="#report">Report Address</a></li>
			<li><a href="#abuse_types">Lookup abuse types</a></li>
			<li><a href="#distinct">Lookup distinct reports</a></li>
			<li><a href="#check">Check an address</a></li>
			<li><a href="#download">Download all reports</a></li>
		</ul>

		<p>
			All endpoints have a rate limit of 30 requests per minute or one request every two seconds on average.
			If you need a higher rate limit please <a href="/contact" target=_blank>contact us</a>.
		</p>

		<div class="alert alert-info">
			<h5>How <code>GET</code> Parameters work</h5>
			<code>GET</code> request are used for any API request that does not have a lasting effect.
			For our API all endpoints use <code>GET</code> except the "Report Address" endpoint which uses <code>POST</code>.
			For <code>GET</code> requests you can append parameters to the URL with the first variable indicated by <code>?</code>, second and subsequent indicated by <code>&</code>.
			(E.g. <code>https://www.bitcoinabuse.com/api/endpoint<b>?</b>first=abc<b>&</b>second=xzy</code>)
			<br><br><a href="https://en.wikipedia.org/wiki/Query_string" target="_blank" rel=noopener>Learn more</a>
		</div>

		<br>
		<hr>
		<br>
		<h4 id="report">Report Address</h4>

		<p>
			The Report Address API allows you to report bitcoin addresses automatically.
		</p>

		<p>
			<code>
				POST https://www.bitcoinabuse.com/api/reports/create
			</code>
		</p>

		<h5>Parameters</h5>

		<ul>
			<li>api_token - Required. Get your <a href="/settings#/api" target="_blank">API key</a>.</li>
			<li>address - Required</li>
			<li>abuse_type_id - Required. Integer. See how to <a href="#abuse_types">lookup abuse types</a>. </li>
			<li>abuse_type_other - Required if <i>abuse_type_id</i> is 99 (other). </li>
			<li>abuser</li>
			<li>description</li>
		</ul>

		<br>
		<hr>
		<br>
		<h4 id="abuse_types">Lookup Abuse Type</h4>

		<p>
			This API allows you to look up the <i>abuse_type_id</i> for use with the <a href="#report">report address</a> API.
		</p>

		<p>
			<code>
				GET https://www.bitcoinabuse.com/api/abuse-types
			</code>
		</p>

		<br>
		<hr>
		<br>
		<h4 id="distinct">Lookup Distinct Reports</h4>

		<p>
			<code>
				GET https://www.bitcoinabuse.com/api/reports/distinct
			</code>
		</p>

		<p>This report is cached and only updates once per hour.</p>

		<h5>Parameters</h5>

		<ul>
			<li>api_token - Required. Get your <a href="/settings#/api" target="_blank">API key</a>.</li>
			<li>page - Optional. Integer great than or equal to 1.</li>
			<li>reverse - Optional. Reverse the order so oldest reports are first. Use <code>&reverse=true</code></li>
		</ul>

		<br>
		<hr>
		<br>
		<h4 id="check">Check Address</h4>

		<p>
			<code>
				GET https://www.bitcoinabuse.com/api/reports/check
			</code>
		</p>

		<p>This report is cached and only updates once per hour.</p>

		<h5>Parameters</h5>

		<ul>
			<li>api_token - Required. Get your <a href="/settings#/api" target="_blank">API key</a>.</li>
			<li>address - Required</li>
		</ul>

		<h5>Example</h5>

		<p>
			<code>
				https://www.bitcoinabuse.com/api/reports/check?address={ADDRESS}&api_token={API_TOKEN}
			</code>
		</p>



		<br>
		<hr>
		<br>
		<h4 id="download">Complete Download</h4>

		<p>
			<code>
				GET https://www.bitcoinabuse.com/api/download/{time_period}
			</code>
		</p>

		<p>
			Returns a CSV file containing all reports within the given time period.
			The "1d" file is updated daily in the early morning.
			The "30d" file is updated weekly on Sunday morning.
			The "forever" file is updated monthly on the 15th of the month.
			All updates occur between 2am-3am UTC.
		</p>

		<h5>Parameters</h5>

		<ul>
			<li>api_token - Required. Get your <a href="/settings#/api" target="_blank">API key</a>.</li>
			<li>time_period - Required. Allowed options are <code>1d</code>, <code>30d</code>, or <code>forever</code></li>
		</ul>

		<h5>Example</h5>

		<p>
			<code>
				https://www.bitcoinabuse.com/api/download/30d?api_token={API_TOKEN}
			</code>
		</p>

		<hr>
		<br>
		<br>
		<p class="text-center">Questions or comments? <a href="/contact" target=_blank>Contact us</a></p>
		<br>
		<br>
	</div>
</main>

@stop
