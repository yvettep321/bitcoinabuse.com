<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	@include('includes.nav.brand')
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarCollapse">
		@include('includes.nav.left')

		<ul class="navbar-nav ml-auto">
			<li class="mr-2 my-3 my-lg-0">
				<form onsubmit="event.preventDefault(); window.goToAddress($('#header-search').val());">
					<input class="form-control mr-sm-2" type="text" id="header-search" required placeholder="Search Bitcoin Address">
					<input type="submit" style="display:none"/>
				</form>
			</li>
			<li class="nav-item">
				<a class="btn btn-secondary mx-1" style="height:100%" href="/login"> {{__('Login')}} <i class="fas fa-sign-in-alt"></i></a>
			</li>
			<li class="nav-item">
				<a class="btn btn-primary mx-1 mt-2 mt-lg-0" style="height:100%" href="/register"> {{__('Register')}} <i class="fas fa-user-plus"></i> </a>
			</li>
		</ul>
	</div>
</nav>
