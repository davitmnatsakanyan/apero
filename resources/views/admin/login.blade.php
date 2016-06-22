<!DOCTYPE html>

<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.1.1
Version: 2.0.2
Author: KeenThemes
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
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta content="" name="description"/>
<meta content="" name="author"/>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
{!! Html::style('administration/assets/plugins/font-awesome/css/font-awesome.min.css') !!}
{!! Html::style('administration/assets/plugins/bootstrap/css/bootstrap.min.css') !!}
{!! Html::style('administration/assets/plugins/uniform/css/uniform.default.css') !!}
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
{!! Html::style('administration/assets/plugins/select2/select2-metronic.css') !!}
{!! Html::style('administration/assets/plugins/select2/select2.css') !!}
<!-- END PAGE LEVEL SCRIPTS -->
<!-- BEGIN THEME STYLES -->
{!! Html::style('administration/assets/css/style-metronic.css') !!}
{!! Html::style('administration/assets/css/style.css') !!}
{!! Html::style('administration/assets/css/style-responsive.css') !!}
{!! Html::style('administration/assets/css/plugins.css') !!}
{!! Html::style('administration/assets/css/themes/default.css', ['id' => "style_color"]) !!}
{!! Html::style('administration/assets/css/pages/login.css') !!}
{!! Html::style('administration/assets/css/custom.css') !!}
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- BEGIN BODY -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
	<a href="index.html">
		<img src={{ url('administration/assets/img/logo-big.png' )}} alt=""/>
	</a>
</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
	<!-- BEGIN LOGIN FORM -->
        @include ('layouts/messages')
        {!!Form::open(['url' => url('admin/login'), 'method' => 'post' ,'class' => 'login-form'])!!}
        
		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-danger display-hide">
			<button class="close" data-close="alert"></button>
			<span>
				 Enter any username and password.
			</span>
		</div>
		<div class="form-group">
			<!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
			<label class="control-label visible-ie8 visible-ie9">Username</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
                                {!! Form::text('email',NULL, ['class' => "form-control placeholder-no-fix", 'placeholder' => "Email" ])!!}
			</div>
		</div>
		<div class="form-group">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
                                {!! Form::password('password', ['class' => "form-control placeholder-no-fix", 'placeholder' => "Password" ])!!}
			</div>
		</div>
		<div class="form-actions">
                         {!! Form::submit('Login',['class' =>"btn green pull-right" ])!!}
			 <i class="m-icon-swapright m-icon-white"></i>
			</button>
		</div>
	{!! Form::close()!!}
	<!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
	<script type="administration/assets/plugins/respond.min.js"></script>
	<script type="administration/assets/plugins/excanvas.min.js"></script> 
	<![endif]-->
{!! Html::script('administration/assets/plugins/jquery-1.10.2.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery-migrate-1.2.1.min.js') !!}
{!! Html::script('administration/assets/plugins/bootstrap/js/bootstrap.min.js') !!}
{!! Html::script('administration/assets/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery.blockui.min.js') !!}
{!! Html::script('administration/assets/plugins/jquery.cokie.min.js') !!}
{!! Html::script('administration/assets/plugins/uniform/jquery.uniform.min.js') !!}
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! Html::script('administration/assets/plugins/jquery-validation/dist/jquery.validate.min.js') !!}
{!! Html::script('administration/assets/plugins/select2/select2.min.js') !!}

<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
{!! Html::script('administration/assets/scripts/core/app.js') !!}
{!! Html::script('administration/assets/scripts/custom/login.js') !!}
<!-- END PAGE LEVEL SCRIPTS -->
{!! Html::script('administration/assets/scripts/login_common.js') !!}
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>