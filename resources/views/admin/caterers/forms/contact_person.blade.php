
{!! Form::open([
'method' => 'PATCH',
'url' => ['/admin/caterers', $caterer->id],
'class' => 'form-horizontal',
]) !!}

<div class="form-group {{ $errors->has('cp_title') ? 'has-error' : ''}}">
    {!! Form::label('cp_title', 'Title', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('cp_title',$caterer->contact_person->title, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('cp_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cp_prename') ? 'has-error' : ''}}">
    {!! Form::label('cp_prename', 'Prename', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('cp_prename', $caterer->contact_person->prename, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('cp_prename', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cp_name') ? 'has-error' : ''}}">
    {!! Form::label('cp_name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('cp_name', $caterer->contact_person->name, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('cp_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cp_emial') ? 'has-error' : ''}}">
    {!! Form::label('cp_email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('cp_email', $caterer->contact_person->email, ['class' => 'form-control']) !!}
        {!! $errors->first('cp_email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cp_phone') ? 'has-error' : ''}}">
    {!! Form::label('cp_phone', 'Phone', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('cp_phone', $caterer->contact_person->phone, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('cp_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('cp_mobile') ? 'has-error' : ''}}">
    {!! Form::label('cp_mobile', 'Mobile', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('cp_mobile', $caterer->contact_person->mobile, ['class' => 'form-control', 'required' => 'required']) !!}
        {!! $errors->first('cp_mobile', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
{{--               {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}--}}
        <button type="submit" name="edit" value="cp_edit" class="btn btn-primary form-control">Updtae</button>
{{--        {!! Form::button('name', 'Update',['class' => 'btn btn-primary form-control' ,'type'=>'submit']) !!}--}}
    </div>
</div>

{!! Form::close() !!}