@if (Auth::check())
	@include('includes.nav.user')
@else
	@include('includes.nav.guest')
@endif

<div class="text-center" style="background: linear-gradient(90deg, #fb9724 0%, #dc2562 100%); color: white; padding: 1em;">
	<i class="fas fa-exclamation-triangle" style="color:#fffafb;"></i>
	<b>Do not pay ransoms. Extortion emails are 100% fake.</b> <a style="color:#fffafb;" href="/faq">More information &raquo;</a>
</div>