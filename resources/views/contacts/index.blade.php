@extends('layouts.main')

@section('content')

<section class="contact container">
	<div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
		<div class="inner clearfix">
			<div class="title text-center"><h2>CONTACT US</h2></div>

			<script type="text/javascript" src="http://assets.freshdesk.com/widget/freshwidget.js"></script>
			<style type="text/css" media="screen, projection">
        		@import url(http://assets.freshdesk.com/widget/freshwidget.css); 
      		</style>

      		<iframe title="Feedback Form" class="freshwidget-embedded-form" id="freshwidget-embedded-form" src="https://f45training.freshdesk.com/widgets/feedback_widget/new?&widgetType=embedded&screenshot=no" scrolling="no" height="500px" width="100%" frameborder="0" >
      		</iframe>

		</div>
	</div>
</section>

@endsection