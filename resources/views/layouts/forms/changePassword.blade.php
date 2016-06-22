{!! Form::open(['url' => url( $role.'/settings/change-password'), 'method' => 'post','role'=>"form"])!!}

  <div class="form-group">
    {!! Form::label('password','New Password')!!}
    {!! Form::password('password', ["class"=>"form-control"] )!!}
  </div>

  <div class="form-group">
    {!! Form::label('password_confirmation','New Password Comfirmation')!!}
    {!! Form::password('password_confirmation', ["class"=>"form-control"] )!!}
  </div>

    {!! Form::button('Change Password',['type'=>'submit','class'=>'btn btn-default'])!!}
{!! Form::close() !!}
