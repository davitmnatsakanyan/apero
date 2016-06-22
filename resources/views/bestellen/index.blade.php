@extends('layouts/index')

@section('css')
    {!! Html::style("css/fm.checkator.jquery.css")!!}
@stop
    
@section('content')
     <section id="content">
			
		<div  class="hillfe-content caterer-content">
			<div class="container">

				<div class="row">

					<div class="col-md-10 col-md-offset-1">

						<div class="apero-carterer apero-bestellen clearfix">

							<h2 class="clearfix">Ihr Warenkorb bei Spitzen-Apero Caterer</h2>

							@include('bestellen/produkts')

							@include('bestellen/address')

						</div>

						@include('bestellen/zahlung')

					</div>

				</div>

			</div>
		</div>

	</section>
@stop


