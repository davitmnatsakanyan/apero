@extends ('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
		<div class="page-content">
                   @include('admin/user_managment/forms/edit_user')
                </div>
    </div>
                   
@stop

