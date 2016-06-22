<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apero</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    {!!Html::style("css/bootstrap.min.css")!!}
    {!!Html::style("css/font-awesome.css")!!}
    {!!Html::style("css/style.css")!!}
    {!!Html::style("css/bootstrap-datepicker.min.css")!!}
    @yield('css')
    
</head>
<body>
	
	<!-- Header -->
          @include('layouts/header')
	<!-- End Header -->


	<!-- Content -->
	   @yield('content')
	<!-- End Content -->

	<!-- Footer -->
	   @include('layouts/footer')
	<!-- End Footer -->

         {!!Html::script("js/jquery.min.js")!!}
         {!!Html::script("js/bootstrap.min.js")!!}
         {!!Html::script("js/moment.js")!!}
         {!!Html::script("js/bootstrap-datetimepicker.js")!!}
         {!!Html::script("js/common.js")!!}
         @yield('js')
</body>
</html>
