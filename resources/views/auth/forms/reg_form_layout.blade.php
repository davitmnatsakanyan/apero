@include('layouts/messages')

{!! Form::open(['url' => url('auth/register'), 'method' => 'post'])!!}
{!! Form::hidden('role', $userType) !!}
  <div class="form-group">
    {!! Form::label('company','Firma')!!}
    {!! Form::text('company',NULL, ['placeholder' => 'Firma','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('name','Name')!!}
    {!! Form::text('name',NULL, ['placeholder' => 'Anrede','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('address','Adresse')!!}
    {!! Form::text('address',NULL, ['placeholder' => 'Adresse','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('pobox','Postfach')!!}
    {!! Form::text('pobox',NULL, ['placeholder' => 'Postfach','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('zip','PLZ')!!}
    {!! Form::text('zip',NULL, ['placeholder' => 'PLZ','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('city','City')!!}
    {!! Form::text('city',NULL, ['placeholder' => 'Ort','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('country','Country')!!}
    {!! Form::text('country',NULL, ['placeholder' => 'Land','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('email','Email')!!}
    {!! Form::text('email',NULL, ['class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('password','Password')!!}
    {!! Form::password('password',NULL, ['class' => 'form-control'])!!}
  </div>  
  <div class="form-group">
    {!! Form::label('password_confirmation','Confirm Password')!!}
    {!! Form::password('password_confirmation',NULL, ['class' => 'form-control'])!!}
  </div>  
  <div class="form-group">
    {!! Form::label('phone','Telefon')!!}
    {!! Form::text('phone',NULL, ['placeholder' => 'Telefon','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('mobile','Mobile')!!}
    {!! Form::text('mobile',NULL, ['placeholder' => 'Mobile','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('created_ip','IP')!!}
    {!! Form::text('created_ip',NULL, ['placeholder' => 'Mobile','class' => 'form-control'])!!}
  </div>
  @yield('reg_content')
  <div>
    {!! Form::submit('Log In',['class' => 'btn btn-primary'])!!}
  </div> 
{!! Form::close() !!}


