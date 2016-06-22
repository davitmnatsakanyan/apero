@include('layouts/messages')

<form ng-submit="reg_submit()" ng-controller="AuthController">

  <input type="hidden" name="_token" ng-init="data._token='{{ csrf_token() }}'" ng-model="data._token">
  <input type="hidden" name="role" ng-init="data.role='{{ $userType }}'" ng-model="data.role">

  <div class="form-group">
    {!! Form::label('company','Firma')!!}
    {!! Form::text('company',NULL, ['placeholder' => 'Firma','class' => 'form-control', 'ng-model' => 'data.company'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('name','Name')!!}
    {!! Form::text('name',NULL, ['placeholder' => 'Anrede','class' => 'form-control', 'ng-model' => 'data.name'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('address','Adresse')!!}
    {!! Form::text('address',NULL, ['placeholder' => 'Adresse','class' => 'form-control', 'ng-model' => 'data.address'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('pobox','Postfach')!!}
    {!! Form::text('pobox',NULL, ['placeholder' => 'Postfach','class' => 'form-control', 'ng-model' => 'data.pobox'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('zip','PLZ')!!}
    {!! Form::text('zip',NULL, ['placeholder' => 'PLZ','class' => 'form-control', 'ng-model' => 'data.zip'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('city','City')!!}
    {!! Form::text('city',NULL, ['placeholder' => 'Ort','class' => 'form-control', 'ng-model' => 'data.city'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('country','Country')!!}
    {!! Form::text('country',NULL, ['placeholder' => 'Land','class' => 'form-control', 'ng-model' => 'data.country'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('email','Email')!!}
    {!! Form::text('email',NULL, ['class' => 'form-control', 'ng-model' => 'data.email'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('password','Password')!!}
    {!! Form::password('password',NULL, ['class' => 'form-control', 'ng-model' => 'data.password'])!!}
  </div>  
  <div class="form-group">
    {!! Form::label('password_confirmation','Confirm Password')!!}
    {!! Form::password('password_confirmation',NULL, ['class' => 'form-control', 'ng-model' => 'data.password_confirmation'])!!}
  </div>  
  <div class="form-group">
    {!! Form::label('phone','Telefon')!!}
    {!! Form::text('phone',NULL, ['placeholder' => 'Telefon','class' => 'form-control', 'ng-model'=> 'data.phone'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('mobile','Mobile')!!}
    {!! Form::text('mobile',NULL, ['placeholder' => 'Mobile','class' => 'form-control', 'ng-model'=> 'data.mobile'])!!}
  </div>
  <div class="form-group">
    {!! Form::label('created_ip','IP')!!}
    {!! Form::text('created_ip',NULL, ['placeholder' => 'Mobile','class' => 'form-control', 'ng-model' => 'data.created_ip'])!!}
  </div>
  @yield('reg_content')
  <div>
    {!! Form::submit('Log In',['class' => 'btn btn-primary'])!!}
  </div> 
</form>


