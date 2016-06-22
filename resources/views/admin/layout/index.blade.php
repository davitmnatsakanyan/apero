<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: 
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Admin Dashboard Template</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
{!! Html::style('administration/assets/plugins/font-awesome/css/font-awesome.min.css' ) !!}
{!! Html::style('administration/assets/plugins/bootstrap/css/bootstrap.min.css' ) !!}
{!! Html::style('administration/assets/plugins/uniform/css/uniform.default.css' ) !!}
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
{!! Html::style('administration/assets/plugins/gritter/css/jquery.gritter.css' ) !!}
{!! Html::style('administration/assets/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css' ) !!}
{!! Html::style('administration/assets/plugins/fullcalendar/fullcalendar/fullcalendar.css' ) !!}
{!! Html::style('administration/assets/plugins/jqvmap/jqvmap/jqvmap.css' ) !!}
{!! Html::style('administration/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.css' ) !!}
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN THEME STYLES -->
{!! Html::style('administration/assets/css/style-metronic.css' ) !!}
{!! Html::style('administration/assets/css/style.css' ) !!}
{!! Html::style('administration/assets/css/style-responsive.css' ) !!}
{!! Html::style('administration/assets/css/plugins.css' ) !!}
{!! Html::style('administration/assets/css/pages/tasks.css' ) !!}
{!! Html::style('administration/assets/css/themes/default.css', [ 'id' => "style_color"]) !!}
{!! Html::style('administration/assets/css/print.css',[ 'media' => "print" ]) !!}
{!! Html::style('administration/assets/css/custom.css') !!}
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
@yield('css')
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body class="page-header-fixed">
<!-- BEGIN HEADER -->
   @include('admin/layout/header');
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	   @include('admin/layout/sidebar')
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	   @yield('content')
	<!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
         @include('admin/layout/footer')
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<script src="assets/plugins/excanvas.min.js"></script> 
<![endif]-->







{!! Html::script('administration/assets/plugins/jquery-1.10.2.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery-migrate-1.2.1.min.js') !!}
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
{!! Html::script('administration/assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js') !!}
{!! Html::script('administration/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('administration/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery.blockui.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery.cokie.min.js') !!}
{!! Html::script('administration/assets/plugins/uniform/jquery.uniform.min.js') !!}
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! Html::script('administration/assets/plugins/jqvmap/jqvmap/jquery.vmap.js') !!}
{!! Html::script('administration/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') !!}
{!! Html::script('administration/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') !!}
{!! Html::script('administration/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') !!}
{!! Html::script('administration/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') !!}
{!! Html::script('administration/assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') !!}
{!! Html::script('administration/assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') !!}
{!! Html::script('administration/assets/plugins/flot/jquery.flot.min.js') !!}
{!! Html::script('administration/assets/plugins/flot/jquery.flot.resize.min.js') !!}
{!! Html::script('administration/assets/plugins/flot/jquery.flot.categories.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery.pulsate.min.js') !!}
{!! Html::script('administration/assets/plugins/bootstrap-daterangepicker/moment.min.js') !!}
{!! Html::script('administration/assets/plugins/bootstrap-daterangepicker/daterangepicker.js') !!}
{!! Html::script('administration/assets/plugins/gritter/js/jquery.gritter.js') !!}
<!-- IMPORTANT! fullcalendar depends on jquery-ui-1.10.3.custom.min.js for drag & drop support -->
{!! Html::script('administration/assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js') !!}
{!! Html::script('administration/assets/plugins/jquery.sparkline.min.js') !!}
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
{!! Html::script('administration/assets/scripts/core/app.js') !!}
{!! Html::script('administration/assets/scripts/custom/index.js') !!}
{!! Html::script('administration/assets/scripts/custom/tasks.js') !!}
<!-- END PAGE LEVEL SCRIPTS -->
{!! Html::script('administration/common.js') !!}

@yield('js')
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>