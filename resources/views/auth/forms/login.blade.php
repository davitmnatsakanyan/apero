{!! Form::open(['url' => url('auth/login'), 'method' => 'post','role'=>"form"])!!}
    {!! Form::hidden('role', $userType) !!}

  <div class="form-group">
    {!! Form::label('email','Email')!!}
    {!! Form::text('email', NULL, ["class"=>"form-control"])!!}
  </div>

  <div class="form-group">
    {!! Form::label('password','Password')!!}
    {!! Form::password('password', ["class"=>"form-control"] )!!}
  </div>

    {!! Form::button('Log In',['type'=>'submit','class'=>'btn btn-default'])!!}
{!! Form::close() !!}

