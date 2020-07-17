{{------------------------------------------}}
{{--              PAGE CONFIG             --}}
{{------------------------------------------}}

@extends('layouts.default')

@section('seo-meta')
<title>Recently Reported Addresses</title>
<meta name=Description content=""/>
@stop

{{------------------------------------------}}
{{--                CONTENT               --}}
{{------------------------------------------}}

@section('content')

<main role="main">
	<div class="jumbotron">
		<div class="container text-center">
			<h1 class="display-4">Recently Reported Addresses</h1>
			<p>Bitcoin Abuse Database Index</p>
		</div>
	</div>

	<div class="container">
		@include('ads.sponsored-banner')
		<div class="row">
			<div class="col-md-6">
				<p>
					This page contains a list of bitcoin addresses used by hackers and scammers.
					Click on an address to learn more about how the address was used.
				</p>
				<p>
					All reports are submitted by our generous community.
					If you are aware of more addresses used in the commission of a crime, <a href="/reports/create">file a report</a>.
				</p>
			</div>
			<div class="col-md-6">
				@include('ads.unit_1')
			</div>
		</div>

		<hr>

		<div class="row">
			@foreach ($reports as $report)
			<div class="col-xl-4 col-md-6 mb-3">
				<a href="/reports/{{ $report->address }}">{{ $report->address }}</a>
				<br> <i>{{ $report->created_at->diffForHumans() }}</i>
			</div>
			@endforeach
		</div>
		{{ $reports->links() }}

		@include('ads.unit_1')

	</div>
</main>

@stop
