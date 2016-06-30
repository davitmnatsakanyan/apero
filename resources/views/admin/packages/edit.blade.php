@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Package {{ $package->id }}</h1>

    {!! Form::model($package, [
        'method' => 'PATCH',
        'url' => ['/admin/packages', $package->id],
        'class' => 'form-horizontal'
    ]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('caterer_id') ? 'has-error' : ''}}">
                {!! Form::label('caterer_id', 'Caterer Id', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('caterer_id', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('caterer_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('deleted_at') ? 'has-error' : ''}}">
                {!! Form::label('deleted_at', 'Deleted At', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('deleted_at', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('deleted_at', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection