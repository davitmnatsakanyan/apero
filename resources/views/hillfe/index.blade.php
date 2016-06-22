@extends('layouts/index')
@section('content')
   <section id="content">
			
		<div  class="hillfe-content">
			<div class="container">
				<div class="row">
				  @include('hillfe/leftSidebar')
                                  @include('hillfe/mainContent')
				</div>
			</div>
		</div>

	</section>
@stop

