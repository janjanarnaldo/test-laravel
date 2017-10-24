<nav class="navbar navbar-default stuck">
	<div class="container">
		<div class="row nav-row">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigationModule" aria-expanded="false"> 
					<span class="sr-only">Toggle navigation</span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
					<span class="icon-bar"></span> 
				</button>

				<a class="navbar-brand" href="/">
					<img class="logo-nav" alt="logo" src="img/f45world-logo.png">
				</a>
			</div>

			<div class="collapse navbar-collapse" id="navigationModule">
				@if(Session::get('user'))
					<ul class="nav navbar-nav nav-left" id="navigation">
						<li>
							<a href="{{URL::to('dashboard')}}">
								<span class="glyphicon glyphicon-home"></span>&nbsp; &nbsp; DASHBOARD
							</a>
						</li>
						<li>
							<a href="{{URL::to('order')}}">
								<span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; &nbsp; ORDER
							</a>
						</li>
						<li>
							<a href="{{URL::to('manuals')}}">
								<span class="glyphicon glyphicon-list-alt"></span>&nbsp; &nbsp; MANUALS
							</a>
						</li>
						<li>
							<a href="{{URL::to('complaints')}}">
								<span class="glyphicon glyphicon-pushpin"></span>&nbsp; &nbsp; WARRANTY CLAIMS
							</a>
						</li>
						<li>
							<a href="{{URL::to('contact')}}">
								<span class="glyphicon glyphicon-earphone"></span>&nbsp; &nbsp; CONTACT
							</a>
						</li>
					</ul>

					<ul class="nav navbar-nav navbar-right" id="authControls">
						<li>
							<a id="btn-logout" class="btn" data-url="{{URL::to('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
						</li>
				    </ul>

				    <input type="hidden" id="franchisee_id" value="{{Session::get('user')['franchisee_id']}}">
				    <input type="hidden" id="base_url" value="{{URL::to('/')}}">
				@else
					{{-- <ul class="nav navbar-nav navbar-right" id="authControls">
						<li>
							<a id="btn-login" class="btn" data-toggle="modal" data-target="#login-form"><i class="fa fa-sign-in"></i> Franchisee Login</a>
						</li>
				    </ul> --}}
				@endif
			</div>
		</div>
	</div>
</nav>

@if(Session::get('user'))
	<div class="container logo">
	  <a class="site-brand" href="/">
	   	   {{ Html::image('img/f45world-logo.png') }}
	  </a>
	</div>
@endif

<!-- partials -->
@include('partials.login-modal')