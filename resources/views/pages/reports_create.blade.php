{{------------------------------------------}}
{{--              PAGE CONFIG             --}}
{{------------------------------------------}}

@extends('layouts.default')

@section('seo-meta')
<title>File Bitcoin Abuse Report | BitcoinAbuse.com</title>
<meta name=Description content=""/>

<script src='https://www.google.com/recaptcha/api.js'></script>
@stop

{{------------------------------------------}}
{{--                CONTENT               --}}
{{------------------------------------------}}

@section('content')

<main role="main">
	<div class="jumbotron">
		<div class="container text-center">
			<h1 class="display-4">File Bitcoin Abuse Report</h1>
		</div>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1">

				@if ($errors->any())
				<div class="card border-danger mb-3">
					<div class="card-header">Errors:</div>
					<div class="card-body text-danger">
						<ul class="card-text">
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
						</ul>
					</div>
				</div>
				@endif

				<div class="card mb-3">
					<div class="card-body">

						<form method="post" action="/reports" id="create-form">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="address">
									Bitcoin Address
									<a tabindex="0"
										class="pointer"
										data-toggle="popover" data-trigger="hover"
										title="Support Address Formats"
										data-content='There are 3 supported formats: <ol class="pl-4"><li>P2PKH (Starts with "1")</li><li>P2SH (Starts with "3")</li><li>Bech32 (Starts with "bc1")</li></ol>'>
									<i class="fas fa-question-circle"></i></a>
								</label>
								<input type="text" name="address" class="form-control" id="address" placeholder="1L1YwaHKfNGxGx6PGYp6SC6uA14tP9FbXt" value="{{ old('address', Request::input('address')) }}">
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="abuse_type_id">Abuse Type</label>
										<select class="form-control" id="abuse_type_id" name="abuse_type_id">
											@foreach ($abuseTypes as $t)
											<option value="{{ $t->id }}"{{ (old('abuse_type_id') == $t->id ? ' selected' : '') }}>{{ $t->label }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="abuse_type_other">If other, please specify</label>
										<input type="text" class="form-control" name="abuse_type_other" id="abuse_type_other" value="{{ old('abuse_type_other') }}" />
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="abuser">Abuser</label>
								<input type="text" class="form-control" name="abuser" id="abuser" placeholder="Name of ransomware, darknet market, etc. (i.e. wannacry or agora)" value="{{ old('abuser') }}" aria-describedby="abuserHelp" />
								<small id="abuserHelp" class="form-text text-muted">Email addresses are almost always spoofed</small>
							</div>

							<div class="form-group">
								<label for="description">Description</label>
								<textarea class="form-control" id="description" name="description" rows="3" placeholder="Provide a description of the abuse" aria-describedby="descriptionHelp">{{ old('description') }}</textarea>
								<small id="descriptionHelp" class="form-text text-muted">Do not include personal information such as your email address</small>
							</div>

							<div class="form-check my-4">
								<input type="checkbox" class="form-check-input" id="optin" name="contact_optin" {{ old('contact_optin') ? "checked" : "" }}>
								<label for="optin">Share my contact information with applicable law enforcement.
									<a tabindex="0"
										class="pointer"
										data-toggle="popover" data-trigger="hover"
										title="Opt-in to Share Contact Info"
										data-content='<b>[Optional]</b> We will share your contact information with applicable law enforcemnt, if requested. In some cases, law enforcement may contact you for a victim statement. We may also share your contact information with qualified investigators who can help recover lost funds.'>
									<i class="fas fa-question-circle"></i></a>
								</label>
							</div>
							<div id="contactblock" style="display:none;">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label for="email">Contact Email Address</label>
											<input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" placeholder="[Private]" />
											<small id="emailHelp" class="form-text text-muted">Optional. Will NOT be made public.</small>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="phone">Contact Phone Number</label>
											<input type="tel" class="form-control" name="phone" id="phone" value="{{ old('phone') }}" placeholder="[Private]" />
											<small id="phoneHelp" class="form-text text-muted">Optional. Will NOT be made public.</small>
										</div>
									</div>
								</div>
								<hr>
							</div>


							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Are you human?</label>
										<div class="g-recaptcha" data-sitekey="{{ config('site.recaptcha_public_key') }}"></div>
									</div>
								</div>
								<div class="col-md-6 text-right">
									<input type="submit" id="submit-button" class="btn btn-primary btn-lg mt-4" />
									<small class="form-text text-muted" id="publicinfowarning">All information submitted will be public</small>
								</div>
							</div>

						</form>

					</div>
				</div>

			</div>
		</div>
	</div>

</main>

<!-- Modal -->
<div class="modal fade" id="warningModal" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-exclamation-triangle text-warning"></i> Warning</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<p>
				The description you entered looks like it might contain your email address.
				Are you sure you want to submit?
			</p>
			<p>
				<b>All information submitted will be public.</b>
			</p>
		</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel, take me back.</button>
				<button type="button" id="submit-override" class="btn btn-primary">Submit Report</button>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

@stop

{{------------------------------------------}}
{{--                SCRIPTS               --}}
{{------------------------------------------}}

@section('page-scripts')

<script>
$('#submit-button').click(function(event)
{
	// Fancy way of seeing if the description contains the @ symbol
	// https://wsvincent.com/javascript-tilde/
	if (~$('#description').val().indexOf("@"))
	{
		$('#warningModal').modal('show')
		return false;
	}

});
$('#submit-override').click(function(event)
{
	$('#create-form').submit();
});


$(function () {
  $('[data-toggle="popover"]').popover({ html: true})
})

$(document).ready(function() {
	if ($('#optin').is(":checked")) {
		showContact()
	}
	$('#optin').click(function() {
		if ($(this).is(':checked')) {
			showContact()
		} else {
			hideContact()
		}
	});
})
function showContact() {
	$('#contactblock').slideDown()
	$('#publicinfowarning').text('All information submitted will be public (Except your contact information will remain private)')
}
function hideContact() {
	$('#contactblock').slideUp()
	$('#publicinfowarning').text('All information submitted will be public')
}
</script>
@stop
