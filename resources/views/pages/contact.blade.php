{{------------------------------------------}}
{{--              PAGE CONFIG             --}}
{{------------------------------------------}}

@extends('layouts.default')

@section('seo-meta')
<title>Contact Us | BitcoinAbuse.com </title>

<script src='https://www.google.com/recaptcha/api.js'></script>

@stop

{{------------------------------------------}}
{{--                CONTENT               --}}
{{------------------------------------------}}

@section('content')

<main role="main">
	<div class="jumbotron">
		<div class="container text-center">
			<h1 class="display-4">Contact Us</h1>
		</div>
	</div>

	<div class="container">

		<div class="row">
			<div class="col-lg-8 offset-lg-2 col-md-10 offset-md-1" >

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


				@if (Request::session()->has('status'))
				<div class="alert alert-primary text-center" role="alert">
					{{ Request::session()->get('status') }}
				</div>
				@endif

				<div class="alert alert-info text-center" role="alert">
					Do not use this form to report abuse. Use the <a href="/reports/create">submit report</a> form.
				</div>
				<div class="alert alert-warning text-center" role="alert">
					In order to protect the integrity of the BitcoinAbuse database we will not remove or edit any reports.
				</div>

				<p>
					Get in touch. We read every message and will do our best to reply.
					Please read the <a href="/faq">FAQ</a> before contacting us.
				</p>
				<div class="card mb-3">
					<div class="card-body">


						<form method="post" action="/contact">
							{{ csrf_field() }}
							<div class="form-group">
								<label for="name">Name</label>
								<input type="text" name="name" class="form-control" id="name" placeholder="Enter name" value="{{ old('name') }}">
							</div>
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" class="form-control" id="email" placeholder="Enter email" aria-describedby="emailHelp" value="{{ old('email') }}">
								<small id="emailHelp" class="form-text text-muted">Email is only used for replying</small>
							</div>
							<div class="form-group">
								<label for="message">Your message</label>
								<textarea class="form-control" id="message" name="message" rows="3" placeholder="Enter message">{{ old('message') }}</textarea>
							</div>

							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Are you human?</label>
										<div class="g-recaptcha" data-sitekey="{{config('site.recaptcha_public_key')}}"></div>
									</div>
								</div>
								<div class="col-md-6 text-right">
									<input type="submit" class="btn btn-primary btn-lg mt-4" />
								</div>
							</div>

						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
@stop