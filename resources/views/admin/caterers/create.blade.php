@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

    <h1>Create New Caterer</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/caterers', 'class' => 'form-horizontal','files' => true]) !!}
            @include('admin/caterers/forms/create')
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
</div>
</div>
@endsection