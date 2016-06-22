@extends('layouts/index')
@section('content')
    <section id="content">
			
		<div  class="hillfe-content caterer-content">
			<div class="container">

				<div class="row">

					<div class="col-md-10 col-md-offset-1">

						@include('caterer/mainContent')

						<div class="einlosern">
							<h2>Gutschein einlosern</h2>
							<div class="gutschein clearfix">
								<input type="text">
								<div class="gutschein-einlosern">
									<a href="#">Gutschein einlosern</a>
								</div>
								<div class="einlosern-bestellen">
									<a href="bestellen.html">Bestellen</a>
								</div>
							</div>
						</div>

					</div>

				</div>

			</div>
		</div>

	</section>
@stop
