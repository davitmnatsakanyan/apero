@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

    <h1>Edit Caterer {{ $caterer->id }}</h1>

    {!! Form::model($caterer, [
        'method' => 'PATCH',
        'url' => ['/admin/caterers', $caterer->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

            @include('admin/caterers/forms/_form')
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