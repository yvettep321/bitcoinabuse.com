<!doctype html>
<html lang="{{ config('app.locale') }}">
	@include('includes.meta')

<body>
	<div id="spark-app" v-cloak>
		@include('includes.header')

		<!-- Main Content -->
		<!-- <main class="py-4"> -->
			@yield('content')
		<!-- </main> -->

		@include('includes.footer')

		<!-- Application Level Modals -->
		@if (Auth::check())
            {{-- @include('spark::modals.notifications') --}}
            {{-- @include('spark::modals.support') --}}
			@include('spark::modals.session-expired')
		@endif
	</div>
    @include('includes.footer-scripts')

</body>
</html>
