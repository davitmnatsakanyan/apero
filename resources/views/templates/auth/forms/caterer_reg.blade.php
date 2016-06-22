@extends('templates/auth/forms/reg_form_layout')
@section('reg_content')
  <div>
    {!! Form::label('description','Beschreibung')!!}
    {!! Form::text('description',NULL, ['placeholder' => 'Beschreibung'])!!}
  </div>
  <div>
    {!! Form::label('products_origin','Produktherkunft')!!}
    {!! Form::text('products_origin',NULL, ['placeholder' => 'Produktherkunft'])!!}
  </div>
@stop

