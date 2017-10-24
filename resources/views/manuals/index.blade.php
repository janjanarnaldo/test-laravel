@extends('layouts.main')

@section('content')

<section id="manual-container" class="container">
	<div class="col-md-12">
		<div class="row">
			<div class="title">
				<h2><span class="glyphicon glyphicon-list-alt"></span> Manuals</h2>
			</div>
			<div class="content manual-content clearfix">
				@forelse($manuals as $manual)
				<div class="col-md-3 item">
					<h3>{{$manual->title}}</h3>
					<a href="{{(substr( $manual->attachment, 0, 3 ) == 'htt' ? '' : URL::to('/')).$manual->attachment}}" target="_blank">
						<img src="{{URL::to('/').$manual->thumbnail}}" style="max-width:45%; max-height: 10em">
					</a>
				</div>
				@empty
					<h4>No data found.</h4>
				@endforelse
			</div>
		</div>
	</div>
</section>

@endsection