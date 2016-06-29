@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Create New Product</h1>
            <hr/>

            {!! Form::open(['url' => '/admin/products', 'class' => 'form-horizontal' ,'files' =>true]) !!}

            <div class="form-group {{ $errors->has('caterer') ? 'has-error' : ''}}">
                {!! Form::label('caterer', 'Caterer', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="col-sm-6">
                        <select class="selectpicker" id="caterer" name = "caterer">
                            <option value=""  >Select caterer</option>
                            @foreach($caterers as $caterer)
                                <option value="{{ $caterer['id'] }}"  >{{$caterer['name']}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('caterer', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
                {!! Form::label('menu', 'Menu', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="col-sm-6">
                        <select class="selectpicker" id="menu" name = "menu">
                        </select>
                        {!! $errors->first('menu', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>



            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
                {!! Form::label('avatar', 'Avatar', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('avatar', ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('ingredinets') ? 'has-error' : ''}}">
                {!! Form::label('ingredinets', 'Ingredinets', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('ingredinets', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('ingredinets', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                {!! Form::label('price', 'Price (EUR)', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}


        </div>
    </div>
@endsection
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    @endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();


        $( "#caterer " ).on( "change", function() {
            var caterer_id = $(this).val();
            if(caterer_id != "")
            $.ajax({
                type: "GET",
                url: BASE_URL+'/admin/products/create/'+caterer_id,
                success : function(data){
                    $( "#menu" ).html('');
                    $( "#menu" ).select2({
                        data : data
                    })
                },
                error: function(error){
                    console.log(error);
                }
            });
        });
    </script>
    @endsection