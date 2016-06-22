@extends('templates/auth/forms/reg_form_layout')
@section('reg_content')
  <div class="form-group">
    {!! Form::label('description','Beschreibung')!!}
    {!! Form::text('description',NULL, ['placeholder' => 'Beschreibung'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('products_origin','Produktherkunft')!!}
    {!! Form::text('products_origin',NULL, ['placeholder' => 'Produktherkunft'])!!}
  </div>
@endsection

