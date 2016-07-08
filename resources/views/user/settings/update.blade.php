@extends ('user/layout/index')
@section('content')
<div style="width: 300px; margin-top: 70px">
  @include('layouts/messages')
{!! Form::open(['url' => url('user/settings/update'), 'method' => 'post','file' => true])!!}
{!! Form::hidden('id', $user->id) !!}
  <div class="form-group">
    {!! Form::label('title','Title')!!}
    {!! Form::text('title',$user->title, ['placeholder' => 'Firma','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('name','Name')!!}
    {!! Form::text('name',$user->name, ['placeholder' => 'Anrede','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('address','Adresse')!!}
    {!! Form::text('address',$user->address, ['placeholder' => 'Adresse','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('pobox','Postfach')!!}
    {!! Form::text('pobox',$user->pobox, ['placeholder' => 'Postfach','class' => 'form-control'])!!}
  </div>

  <div class="form-group">
    {!! Form::label('zip', 'Zip', ['class' => 'col-sm-3 control-label']) !!}
      <select class="selectpicker form-control" id="zip" name="zip">
        @foreach($zips as $zip)
          <option value="{{ $zip->id }}" {{ $zip->id == $user->zip ? 'selected' :'' }}>{{$zip->ZIP ."  ". $zip->city}}</option>
        @endforeach
      </select>
  </div>

  <div class="form-group">
    {!! Form::label('city','City')!!}
    {!! Form::text('city',$user->city, ['placeholder' => 'Ort','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('country','Country')!!}
    {!! Form::text('country',$user->country, ['placeholder' => 'Land','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('email','Email')!!}
    {!! Form::text('email',$user->email, ['class' => 'form-control'])!!}
  </div> 
  <div class="form-group">
    {!! Form::label('phone','Telefon')!!}
    {!! Form::text('phone',$user->phone, ['placeholder' => 'Telefon','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('mobile','Mobile')!!}
    {!! Form::text('mobile',$user->mobile, ['placeholder' => 'Mobile','class' => 'form-control'])!!}
  </div>
  <div>
    {!! Form::submit('Update',['class' => 'btn btn-primary'])!!}
  </div> 
{!! Form::close() !!}
</div>
@stop


