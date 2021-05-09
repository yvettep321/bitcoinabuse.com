{{------------------------------------------}}
{{--              PAGE CONFIG             --}}
{{------------------------------------------}}

@extends('layouts.default')

@section('seo-meta')
<title>Bitcoin Abuse Database: {{ $address }}</title>
<meta name=Description content=""/>
@stop

{{------------------------------------------}}
{{--                CONTENT               --}}
{{------------------------------------------}}

@section('content')

<main role="main">
	<div class="jumbotron">
		<div class="container text-center">
			<h1 class="display-4">Bitcoin Abuse Database</h1>
			<p>Report history for <i><b>{{ $address }}</b></i></p>
		</div>
	</div>

	<div class="container mb-4">
		@include('ads.unit_1')

		@if (Request::session()->has('status'))
		<div class="alert alert-primary text-center" role="alert">
			{{ Request::session()->get('status') }}
		</div>
		@endif

		<div class="row mb-4">
			<div class="col-lg-8">
				<div class="card overflow-hidden">
					<div class="card-header bg-white">
						<h5 class="card-title mb-0">Address {!! (!$found ? '<b>not</b> ' : '') !!}found in database:</h5>
					</div>
						<table id="summary-table" class="table table-striped table-bordered mb-0">
							<tbody>
								<tr><th>Address</th><td><i>{{ $address }}</i></td></tr>
								<tr><th>Report Count</th><td>{{ $reports->total() }}</td></tr>
								<tr><th>Latest Report</th><td>{{ ($found ? $first_date->toRfc822String() : '—') }}<br>{{ ($found ? '('.$first_date->diffForHumans().')' : '') }}</td></tr>
							</tbody>
						</table>
					<div class="card-footer">
						@if (!$found)
							<p class="mb-0 text-muted"><i>This address has not been reported</i>. <a href="/reports/create?address={{ $address }}">File Report</a></p>
						@else
							<a href="https://blockchain.info/address/{{ $address }}" target=_blank class="button small" title="External link to blockchain.info">View address on blockchain.info <i class="fas fa-external-link-square-alt"></i></a>
							<p class="mb-0 text-muted"><i>If you have additional information about this address, please <a href="/reports/create?address={{ $address }}">file a report</a>.</i></p>
						@endif
					</div>
				</div>
			</div>

			<div class="col-lg-4" style="display: none;" id="trace-ad">

				@include('ads.trace-ad-1')

			</div>
		</div>

		<h3>Reports:</h3>
		<table class="table table-striped table-bordered table-responsive-lg">
			<thead>
				<tr>
					<th class="small-2" style="min-width: 125px;">Date</th>
					<th class="small-2">Abuse Type</th>
					<th class="small-6">Description</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($reports as $report)
				<tr>
					<td>{{ $report->created_at->toFormattedDateString() }} </td>
					<td>{{ $report->abuse_type->label }} </td>
					<td>{{ $report->description }} </td>
				</tr>
				@endforeach
			</tbody>
		</table>
		{{ $reports->links() }}

		@if (!$found)
			<p class="lead text-center text-muted"><i>This address has not been reported</i>. <a href="/reports/create?address={{ $address }}">File Report</a></p>
				<hr>
			<br>
			<br>
			<br>
		@endif

	</div>
</main>

@stop


@section('page-scripts')

<script>
$.ajax({
  url: "https://api.blockcypher.com/v1/btc/main/addrs/{{ $address }}/balance",
  success: function(data) {
  	// Thanks blockcypher.com
  	$('#summary-table tr:last').after('<tr><th>Total Bitcoin Received</td><td class="font-weight-bold">'+ data.total_received / 100000000 +' BTC</td></tr>');
  	$('#summary-table tr:last').after('<tr><th>No. Transactions Received</td><td>'+ data.n_tx +'</td></tr>');
  	if (data.total_received > 0) {
  		$('#trace-ad').show();
  	}
  },
  dataType: "json"
});
</script>
@stop
