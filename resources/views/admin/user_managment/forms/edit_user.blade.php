<div>User id : {{$user['id'] }}</div>
{!! Form::open(['url' => url('admin/user/edit'), 'method' => 'post','file' => true])!!}
  {{Form::hidden('id', $user['id'])}}
  <div class="form-group">
    {!! Form::label('name','Name')!!}
    {!! Form::text('name',$user['name'], ['placeholder' => 'Anrede','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('address','Adresse')!!}
    {!! Form::text('address',$user['address'], ['placeholder' => 'Adresse','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('pobox','Postfach')!!}
    {!! Form::text('pobox',$user['pobox'], ['placeholder' => 'Postfach','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('zip','PLZ')!!}
    {!! Form::text('zip',$user['zip'], ['placeholder' => 'PLZ','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('city','City')!!}
    {!! Form::text('city',$user['city'], ['placeholder' => 'Ort','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('country','Country')!!}
    {!! Form::text('country',$user['country'], ['placeholder' => 'Land','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('email','Email')!!}
    {!! Form::text('email',$user['email'], ['class' => 'form-control'])!!}
  </div> 
  <div class="form-group">
    {!! Form::label('phone','Telefon')!!}
    {!! Form::text('phone',$user['phone'], ['placeholder' => 'Telefon','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('password','Password')!!}
    {!! Form::password('password',Null, ['class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('mobile','Mobile')!!}
    {!! Form::text('mobile',$user['mobile'], ['placeholder' => 'Mobile','class' => 'form-control'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('created_ip','IP')!!}
    {!! Form::text('created_ip',NULL, ['placeholder' => 'Mobile','class' => 'form-control'])!!}
  </div>
  <div>
    {!! Form::submit('Update',['class' => 'btn btn-primary'])!!}
  </div> 
{!! Form::close() !!}