<spark-navbar
		:user="user"
		:teams="teams"
		:current-team="currentTeam"
		:unread-announcements-count="unreadAnnouncementsCount"
		:unread-notifications-count="unreadNotificationsCount"
		inline-template>


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
				<li class="nav-item dropdown">
					<a href="#" class="d-block d-md-flex text-center nav-link dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img :src="user.photo_url" class="dropdown-toggle-image spark-nav-profile-photo">
						<span class="d-md-block">@{{ user.name }}</span>
					</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
						<!-- Impersonation -->
						@if (session('spark:impersonator'))
							<h6 class="dropdown-header">{{__('Impersonation')}}</h6>

							<!-- Stop Impersonating -->
							<a class="dropdown-item" href="/spark/kiosk/users/stop-impersonating">
								<i class="fas fa-fw text-left fa-btn fa-user-secret"></i> {{__('Back To My Account')}}
							</a>

							<div class="dropdown-divider"></div>
						@endif

						<!-- Developer -->
						@if (Spark::developer(Auth::user()->email))
							<h6 class="dropdown-header">{{__('Developer')}}</h6>

							<!-- Kiosk -->
							<a class="dropdown-item" href="/spark/kiosk">
								<i class="fab text-left fa-btn fa-fort-awesome"></i> {{__('Kiosk')}}
							</a>

							<a class="dropdown-item" href="/telescope">
								<i class="fas text-left fa-btn fa-binoculars"></i> {{__('Telescope')}}
							</a>

							<div class="dropdown-divider"></div>

						@endif

						<!-- Subscription Reminders -->
						{{-- @include('spark::nav.subscriptions') --}}

						<!-- Settings -->
						<h6 class="dropdown-header">{{__('Settings')}}</h6>

						<!-- Your Settings -->
						<a class="dropdown-item" href="/settings">
							<i class="fa fa-fw text-left fa-btn fa-cog"></i> {{__('Your Settings')}}
						</a>

						<div class="dropdown-divider"></div>

						{{-- @if (Spark::usesTeams() && (Spark::createsAdditionalTeams() || Spark::showsTeamSwitcher()))
							<!-- Team Settings -->
							@include('spark::nav.teams')
						@endif --}}

						{{-- @if (Spark::hasSupportAddress())
							<!-- Support -->
							@include('spark::nav.support')
						@endif --}}

						<!-- Logout -->
						<a class="dropdown-item" href="/logout">
							<i class="fas fa-fw text-left fa-btn fa-sign-out-alt"></i> {{__('Logout')}}
						</a>
					</div>
				</li>
			</ul>


		</div>
	</nav>

</spark-navbar>

