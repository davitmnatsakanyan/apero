@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h1>Create New Kitchen</h1>
            <hr/>

            {!! Form::open(['url' => '/admin/kitchens', 'class' => 'form-horizontal']) !!}

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection