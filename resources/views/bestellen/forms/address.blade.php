{!! Form::open(['url' => '', 'method' => 'put', 'class' => 'form-inline']) !!}
    <div class="form-group">
        {!! Form::label('exampleInputName2', 'Firma', []) !!}
        {!! Form::text('exampleInputName2', NULL, ['placeholder' => 'Arnold', 'class' => 'form-control' ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('exampleInputName3', 'Vorname', []) !!}
        {!! Form::text('exampleInputName3', NULL, ['placeholder' => 'Tempees', 'class' => 'form-control' ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('exampleInputName4', 'Names', []) !!}
        {!! Form::text('exampleInputName4', NULL, ['placeholder' => 'Vorname', 'class' => 'form-control' ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('exampleInputName5', 'Strasse', []) !!}
        {!! Form::text('exampleInputName5', NULL, ['placeholder' => 'Lorem Ipsum', 'class' => 'form-control' ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('exampleInputName6', 'PLZ', []) !!}
        {!! Form::text('exampleInputName6', NULL, ['placeholder' => 'tempees@tempees.com', 'class' => 'form-control' ]) !!} 
    </div>

    <div class="form-group">
        {!! Form::label('exampleInputName7', 'ort', []) !!}
        {!! Form::text('exampleInputName7', NULL, ['placeholder' => 'Fifth Avenue', 'class' => 'form-control' ]) !!}
    </div>

    <div class="loging">

        <label class="checkbox-inline">{!! Form::checkbox('name', '') !!} Liferadrese Entspricht Recjungsadresse  </label>

        <div class="loging-login">
                <p>Login fur bestehande Kunden </p>
                    <div class="form-group">
                        {!! Form::label('exampleInputName8', 'E-mail', []) !!}
                        {!! Form::email('exampleInputName8', NULL, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('exampleInputName9', 'Password', []) !!}
                        {!! Form::password('exampleInputName9', NULL, ['class' => 'form-control' ]) !!}
                    </div>
                </div>
        </div>

{!! Form::close() !!}
