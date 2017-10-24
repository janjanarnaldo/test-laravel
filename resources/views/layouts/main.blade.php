@include('includes.header')
	
	<div class="page">
		<div class="page--inner">
			@include('includes.navbar')
			<div class="content">
				 <div class="loader">
		            <div class="loader-content">
		                {{ Html::image('img/status.gif') }} Please Wait . . . 
		            </div>
		        </div>

				<div class="content-inner">
					@yield('content')
				</div>
			</div>
		</div>
	</div>
	

@include('includes.footer')