@extends('caterer/layout/index')

@section('content')


            <h1>Create New Package</h1>
            <hr/>
            @include ('layouts/messages')
            {!! Form::open(['url' => '/caterer/product/package', 'class' => 'form-horizontal', 'method' => 'POST', 'files' => true]) !!}

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

            {!! Form::hidden('caterer', $caterer->id) !!}

            <div class="form-group {{ $errors->has('product') ? 'has-error' : ''}}">
                {!! Form::label('product', 'Products', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="product" name = "product[]", multiple = 'multiple'>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('product', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <ul class="ul_current" style = "list-style-type: none" >
            </ul>


            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
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


@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
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


        $( "#product " ).on( "select2:select", function(e) {
            var product = e.params.data.id;
            $('.ul_current').append($('<li>' +
                    '<label >' + e.params.data.text + '</label>' +
                    '<input type="number" name="product_count.' + e.params.data.id + '">' +
                    '</li>'));
        });

        $( "#product " ).on( "select2:unselect", function(e) {
            var product = e.params.data.id;
            console.log($("input[name='product_count."+ product+"']").closest('li').html(''));
        });


    </script>
@endsection
