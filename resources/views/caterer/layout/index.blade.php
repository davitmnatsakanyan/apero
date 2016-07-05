<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>

    <title>Apero|User template</title>

    <!-- Bootstrap core CSS -->
    {!! Html::style('css/bootstrap.min.css' ) !!}

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {!! Html::style('assets/css/ie10-viewport-bug-workaround.css' ) !!}
     

    <!-- Custom styles for this template
    <link href="dashboard.css" rel="stylesheet"> 
     -->
     
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif] -->
    {!! Html::script('assets/js/ie-emulation-modes-warning.js') !!}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script>
      var BASE_URL = '{{ url('/') }}';
    </script>

    @yield ('css')
  </head>

  <body>

    @include ('caterer/layout/header')

    <div class="container-fluid">
      <div class="row" style="margin-top: 30px">
        @yield ('content')
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery.min.js"><\/script>')</script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
   {!! Html::script('assets/js/vendor/holder.min.js') !!}
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    {!! Html::script('assets/js/ie10-viewport-bug-workaround.js') !!}

    {!! Html::script('js/bootstrap.min.js') !!}

    @yield ('js')
  </body>
</html>

