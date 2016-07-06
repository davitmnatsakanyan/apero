@extends ('caterer/layout/index')
@section('content')
    @include('layouts/messages')
    <div style="margin-top: 50px">
        {!! Form::model($my_caterer,[
        'url' => url('caterer/settings/update'),
        'method' => 'post',
        'files' => true,
        'class' => 'form-horizontal',])!!}

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <div id="imagePreview" style="width: 120px;
                        height: 120px;
                        background-position: center center;
                        background-size: cover;
                        background-image: url( {{url('images/products/' . $caterer->avatar)}} );
                        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3)"></div>
            </div>
        </div>


        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}" id="file_avatar">
            {!! Form::label('avatar', 'Avatar', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::file('avatar', ['class' => 'form-control']) !!}
                {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('company') ? 'has-error' : ''}}">
            {!! Form::label('company', 'Company', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('company', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
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
                        <option value="{{ $zip['id'] }}" {{ $zip['id'] == $caterer->zip ? 'selected' :'' }}>{{$zip['ZIP'] ."  ". $zip['city']}}</option>
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
                {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
            {!! Form::label('phone', 'Phone', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('fax') ? 'has-error' : ''}}">
            {!! Form::label('fax', 'Fax', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('fax', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('fax', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
            {!! Form::label('description', 'Description', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <hr>
        <h1>Contact person information</h1>

        <div class="form-group {{ $errors->has('cp_title') ? 'has-error' : ''}}">
            {!! Form::label('cp_title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('cp_title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('cp_title', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('cp_prename') ? 'has-error' : ''}}">
            {!! Form::label('cp_prename', 'Prename', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('cp_prename', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('cp_prename', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('cp_name') ? 'has-error' : ''}}">
            {!! Form::label('cp_name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('cp_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('cp_name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('cp_prename') ? 'has-error' : ''}}">
            {!! Form::label('cp_prename', 'Prename', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('cp_prename', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('cp_prename', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('cp_mobile') ? 'has-error' : ''}}">
            {!! Form::label('cp_mobile', 'Prename', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('cp_mobile', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('cp_mobile', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('cp_phone') ? 'has-error' : ''}}">
            {!! Form::label('cp_phone', 'Phone', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('cp_phone', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('cp_phone', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="form-group {{ $errors->has('cp_email') ? 'has-error' : ''}}">
            {!! Form::label('cp_email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('cp_email', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('cp_email', '<p class="help-block">:message</p>') !!}
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Update',['class' => 'btn btn-primary'])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@stop

