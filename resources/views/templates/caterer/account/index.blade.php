@extends ('templates/caterer/layout/index')

@section('content')
<div style="width: 300px; margin-top: 50px">
@include('layouts/messages')
@if(session('message'))
  {{session('message')}}
@endif

</div>
@stop
