@extends('admin.layout.index')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">

    <h1>Create New Member</h1>
    <hr/>

    {!! Form::open(['url' => '/admin/members', 'class' => 'form-horizontal', 'files' => true]) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('address') ? 'has-error' : ''}}">
                {!! Form::label('address', 'Address', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('pobox') ? 'has-error' : ''}}">
                {!! Form::label('pobox', 'Pobox', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('pobox', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('pobox', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        <div class="form-group {{ $errors->has('caterer') ? 'has-error' : ''}}">
            {!! Form::label('zip', 'Zip', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <select class="selectpicker form-control" id="zip" name="zip">
                    @foreach($zips as $zip)
                        <option value="{{ $zip->id }}"}}>{{$zip['ZIP'] ."  ". $zip['city']}}</option>
                    @endforeach
                </select>
                {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
            <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                {!! Form::label('city', 'City', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('city', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
                {!! Form::label('country', 'Country', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('country', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::email('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                {!! Form::label('phone', 'Phone', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('mobile') ? 'has-error' : ''}}">
                {!! Form::label('mobile', 'Mobile', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('mobile', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('mobile', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
                {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
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