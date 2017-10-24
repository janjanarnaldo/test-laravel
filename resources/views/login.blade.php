@extends('layouts.main')

@section('content')
	<header class="hero-section">
		<section class="container text-center welcome-message" style="padding-top:6%;">
			<div class="row">
				<div class="col-md-12">
					<img src="img/f45world-large.png" alt="f45world large">
					<br><br>
					<h1>Supply Chain Management for F45 Training</h1>

					<h2>F45 World provides international supply chain management services for all F45 franchisees. Our global logistics network manages the supply of all required F45 equipment to both new and existing franchisees</h2>
					<br>

					<h2>F45 Training is the worlds fastest growing fitness franchisee, <a href="http://f45training.com">Find out more</a></h2>
				</div>
			</div>
		</section>
	</header>
	
	<input type="hidden" value="{{$errors->first()}}" id="login-error">	
@endsection


@push('scripts')
{!! Html::script('js/auth/auth.js') !!}
@endpush