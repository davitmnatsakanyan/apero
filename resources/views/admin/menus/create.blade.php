@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Create New Menu</h1>
            <hr/>

            {!! Form::open([
            'url' => '/admin/menus',
            'class' => 'form-horizontal',
            'files' => true,
            ]) !!}

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <div id="imagePreview" style="width: 120px;
                            height: 120px;
                            background-position: center center;
                            background-size: cover;
                            background-image: url( {{url('images/menus/')}} );
                            -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3)"></div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}" id="file_avatar">
                {!! Form::label('avatar', 'Avatar', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('avatar', ['class' => 'form-control']) !!}
                    {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('kitchen') ? 'has-error' : ''}}">
                {!! Form::label('kitchen', 'Kitchen', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="kitchen" name = "kitchen[]" multiple="multiple">
                        @foreach($kitchens as $kitchen)
                            <option value="{{ $kitchen['id'] }}"  >{{$kitchen['name']}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
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
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


@section('js')

    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $('select').select2();


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
    @endsection

@section('css')

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    @stop