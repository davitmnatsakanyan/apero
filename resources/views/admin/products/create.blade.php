@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Create New Product</h1>
            <hr/>

            {!! Form::open(['url' => '/admin/products', 'class' => 'form-horizontal' ,'files' =>true]) !!}

            <div class="form-group {{ $errors->has('caterer') ? 'has-error' : ''}}">
                {!! Form::label('caterer', 'Caterer', ['class' => 'col-sm-3 control-label', ]) !!}
                <div class="col-sm-6">
                    <div class="col-sm-6">
                        <select class="selectpicker form-control" id="caterer" name="caterer" >
                            <option value="">Select caterer</option>
                            @foreach($caterers as $caterer)
                                <option value="{{ $caterer['id'] }}">{{$caterer['company']}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('caterer', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('kitchen') ? 'has-error' : ''}}">
                {!! Form::label('kitchen', 'Kitchen', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="col-sm-6">
                        <select class="selectpicker form-control" id="kitchen" name="kitcehn" data-placeholder="Select kitchen">
                        </select>
                        {!! $errors->first('caterer', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
                {!! Form::label('menu', 'Menu', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <div class="col-sm-6">
                        <select class="selectpicker form-control" id="menu" name="menu" data-placeholder="Select menu">
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

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <div id="imagePreview" style="width: 120px;
                                                height: 120px;
                                                background-position: center center;
                                                background-size: cover;
                                                -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3)"></div>
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();


        $("#caterer ").on("change", function () {
            var caterer_id = $(this).val();
            if (caterer_id != "")
                $.ajax({
                    type: "GET",
                    url: BASE_URL + '/admin/products/create/' + caterer_id,
                    success: function (data) {
                        $("#kitchen").html('');
                        $("#kitchen").select2({
                            data: data
                        })
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            else{
                $("#kitchen").html('');
                $("#menu").html('');
            }
        });


        $("#kitchen ").on("change", function () {
            var kitchen_id = $(this).val();
            console.log(kitchen_id);
            if (kitchen_id != "")
                $.ajax({
                    type: "GET",
                    url: BASE_URL + '/admin/products/create/menu/' + kitchen_id,
                    success: function (data) {
                        $("#menu").html('');
                        $("#menu").select2({
                            data: data
                        })
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
        });
    </script>

    <script>
        $(function() {
            $("#avatar").on("change", function()
            {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        $("#imagePreview").css("background-image", "url("+this.result+")");
                    }
                }
            });
        });
    </script>
@endsection