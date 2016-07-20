{!! Form::model( [
               'method' => 'PATCH',
               'url' => ['/admin/caterers'],
               'class' => 'form-horizontal',
           ]) !!}
<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    {!! Form::label('company', 'Company', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('company', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('addres') ? 'has-error' : ''}}">
    {!! Form::label('addres', 'Address', ['class' => 'col-sm-3 control-label']) !!}
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
<div class="form-group {{ $errors->has('emial') ? 'has-error' : ''}}">
    {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
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
<div class="form-group {{ $errors->has('contry') ? 'has-error' : ''}}">
    {!! Form::label('country', 'Country', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('country', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('descripthion') ? 'has-error' : ''}}">
    {!! Form::label('description', 'Descripthion', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('products_origin') ? 'has-error' : ''}}">
    {!! Form::label('products_origin', 'Products Origin', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('products_origin', null, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('products_origin', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
    {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::password('password',null, ['class' => 'form-control']) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {{--{!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}--}}
        <button type="submit" name="edit"  value="ci_edit" class="btn btn-primary form-control">Updtae</button>
    </div>
</div>

{!! Form::close() !!}