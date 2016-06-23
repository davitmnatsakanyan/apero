@extends ('templates/caterer/layout/index')
@section ('content')
    <div style="width:300px; margin-top: 50px; margin-left: 20px;">
        @include ('layouts/messages')
        @include('caterer/product/single/forms/add')
    </div>
@stop