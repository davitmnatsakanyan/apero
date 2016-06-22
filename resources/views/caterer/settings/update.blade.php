@extends ('caterer/layout/index')
@section('content')
@include('layouts/messages')
<div style="width: 300px; margin-top: 50px">
{!! Form::open(['url' => url('caterer/settings/update'), 'method' => 'post','file' => true])!!}
{!! Form::hidden('id', $caterer->id) !!}
  <div class="form-group">
    {!! Form::label('company','Firma')!!}
    {!! Form::text('company',$caterer->company, ['placeholder' => 'Firma','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('name','Name')!!}
    {!! Form::text('name',$caterer->name, ['placeholder' => 'Anrede','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('address','Adresse')!!}
    {!! Form::text('address',$caterer->address, ['placeholder' => 'Adresse','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('pobox','Postfach')!!}
    {!! Form::text('pobox',$caterer->pobox, ['placeholder' => 'Postfach','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('zip','PLZ')!!}
    {!! Form::text('zip',$caterer->zip, ['placeholder' => 'PLZ','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('city','City')!!}
    {!! Form::text('city',$caterer->city, ['placeholder' => 'Ort','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('country','Country')!!}
    {!! Form::text('country',$caterer->country, ['placeholder' => 'Land','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('email','Email')!!}
    {!! Form::text('email',$caterer->email, ['class' => 'form-control'])!!}
  </div> 
  <div class="form-group">
    {!! Form::label('phone','Telefon')!!}
    {!! Form::text('phone',$caterer->phone, ['placeholder' => 'Telefon','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('mobile','Mobile')!!}
    {!! Form::text('mobile',$caterer->mobile, ['placeholder' => 'Mobile','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('created_ip','IP')!!}
    {!! Form::text('created_ip',NULL, ['placeholder' => 'Mobile','class' => 'form-control'])!!}
  </div>
  <div>
    {!! Form::submit('Update',['class' => 'btn btn-primary'])!!}
  </div> 
{!! Form::close() !!}
</div>
@stop

