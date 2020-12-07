{{------------------------------------------}}
{{--              PAGE CONFIG             --}}
{{------------------------------------------}}

@extends('layouts.default')

@section('seo-meta')
<title>Bitcoin Abuse Database</title>
<meta name=Description content="Tracking bitcoin addresses used by ransomware, blackmailers, fraudsters, etc."/>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@stop

{{------------------------------------------}}
{{--                CONTENT               --}}
{{------------------------------------------}}

@section('content')

<main role="main">
	<div class="jumbotron">
		<div class="container">
			<h1 class="display-4">Bitcoin Abuse Database</h1>
			<p>Tracking bitcoin addresses used by ransomware, blackmailers, fraudsters, etc.</p>
			<p>There {{ ($dayCount == 1 ? 'has' : 'have') }} been <span class="lead">{{ number_format($dayCount) }}</span> {{ str_plural('report', $dayCount) }} in the last day, <span class="lead">{{ number_format($weekCount) }}</span> {{ str_plural('report', $weekCount) }} in the last week, and <span class="lead">{{ number_format($monthCount) }}</span> {{ str_plural('report', $monthCount) }} in the last month. </p>
			<p>
				<a class="btn btn-primary btn-lg" href="/reports/create" role="button">File report</a>
				<a class="btn btn-outline-primary btn-lg" href="/reports" role="button">View Reports</a>
			</p>
		</div>
	</div>

	<div class="container">
		@include('ads.unit_1')
		<div class="row">
			<div class="col-md-4">
				<h3>Report Bitcoin Addresses</h3>
			    <p><b>Report Bitcoin Addresses</b> used by criminals and hackers. By reporting bitcoin addresses used by ransomware, you create a permanent public record of the attack. </p>
				<p><a class="btn btn-secondary" href="/reports/create" role="button">File report</a></p>
			</div>
				<div class="col-md-4">
				<h3>Check Report History</h3>
			    <p><b>Check report history</b> to see if address has been linked to a cyber attack. Criminals try laundering bitcoin to sever the connection between the attack and their illicit proceeds. </p>
				<p><a class="btn btn-secondary" href="/reports" role="button">View reports</a></p>
			</div>
			<div class="col-md-4">
				<h3>Monitor Stolen Bitcoin</h3>
	    		<p><b>Monitor stolen bitcoin</b> on the public ledger to see when the hackers try cashing out. Get alerts when coins are moved out of flagged bitcoin addresses. </p>
				<p><a class="btn btn-secondary" href="/faq" role="button">Learn more</a></p>
			</div>
		</div>


	<br>
	<br>
	<hr>
	<br>
	<br>

		<div class="row">
			<div class="col-md-6 mt-4">
				<h3>Reports by Year</h3>
				<div style="height:300px">
					<canvas id="reportsByYear"></canvas>
				</div>
			</div>
			<div class="col-md-6 mt-4">
				<h3>Reports by Month</h3>
				<div style="height:300px">
					<canvas id="reportsByMonth"></canvas>
				</div>
			</div>
			<div class="col-12 mt-4">
				<h3>Reports last 30 days</h3>
				<div style="height:300px">
					<canvas id="reportsByDay"></canvas>
				</div>
			</div>
		</div>

	<br>
	<br>
	<hr>
	<br>
	<br>

	<div class="row">
		<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
			<h3 class="text-center">Lookup Address Now</h3>
			<div class="input-group mb-3">
				<input type="text" class="form-control" id="home-search" placeholder="1L1YwaHKfNGxGx6PGYp6SC6uA14tP9FbXt" aria-describedby="button-addon">
				<div class="input-group-append">
        			<button class="btn btn-outline-secondary" type="button" id="button-addon" onclick="window.goToAddress($('#home-search').val())"><i class="fas fa-search"></i> Search</button>
				</div>
			</div>

		</div>
	</div>

	<br>
	<br>
	<hr>
	<br>
	<br>
	<br>

	<div class="row">
		<div class="col-md-6">
			<h4>What is BitcoinAbuse.com?</h4>
			<p>BitcoinAbuse.com is a public database of bitcoin addresses used by hackers and criminals. Criminals are moving online now more than ever. Ransomeware like <em>wannacry</em> is spreading everyday.</p>
			<p>Bitcoin is anonymous if used <u>perfectly</u>. Luckily, no one is perfect. Even hackers make mistakes. It only takes one mistake to link stolen bitcoin to a hacker's their real identity. </p>
			<p>If you or your organization have been hit by ransomware, <a href="/reports/create">file a report</a>. You can then <a href="/reports">monitor bitcoin addresses</a> reported by you and by others. Thanks for making the Internet a safer place!</p>
			<p><i>~ The BitcoinAbuse Team</i></p>
		</div>
		<div class="col-md-6">
			<div>
				@include('ads.unit_1')
			</div>
		</div>
	</div>

</main>

@stop

@section('page-scripts')

<script>
var ctx = document.getElementById('reportsByYear').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: @json($yearsGraph->pluck('label')),
        datasets: [{
            label: 'Reports Per Year',
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: @json($yearsGraph->pluck('count'))
        }]
    },

    // Configuration options go here
	options: {
		maintainAspectRatio: false,
	    scales: {yAxes: [{ticks: {beginAtZero: true}}]},
	    legend: {display: false},
	}
});

</script>

<script>
var ctx2 = document.getElementById('reportsByMonth').getContext('2d');
var chart = new Chart(ctx2, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: @json($monthsGraph->pluck('label')),
        datasets: [{
            label: 'Reports By Month',
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: @json($monthsGraph->pluck('count'))
        }]
    },

    // Configuration options go here
	options: {
		maintainAspectRatio: false,
	    scales: {yAxes: [{ticks: {beginAtZero: true}}]},
	    legend: {display: false},
	}
});

</script>

<script>
var ctx3 = document.getElementById('reportsByDay').getContext('2d');
var chart = new Chart(ctx3, {
    // The type of chart we want to create
    type: 'bar',

    // The data for our dataset
    data: {
        labels: @json($daysGraph->pluck('label')),
        datasets: [{
            label: 'Reports By Day',
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: @json($daysGraph->pluck('count'))
        }]
    },

    // Configuration options go here
	options: {
		maintainAspectRatio: false,
	    scales: {yAxes: [{ticks: {beginAtZero: true}}]},
	    legend: {display: false},
	}
});

</script>

@stop