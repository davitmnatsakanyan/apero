@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h1>Create New Package</h1>
            <hr/>
              @include ('layouts/messages')
            {!! Form::open(['url' => '/admin/packages', 'class' => 'form-horizontal','files' => true]) !!}

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

            <div class="form-group {{ $errors->has('caterer') ? 'has-error' : ''}}">
                {!! Form::label('caterer', 'Caterer', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="caterer" name="caterer">
                        <option value="" }}>Select caterer</option>
                        @foreach($caterers as $caterer)
                            <option value="{{ $caterer->id }}" }}>{{$caterer->company}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <div class="form-group {{ $errors->has('product') ? 'has-error' : ''}}">
                {!! Form::label('product', 'Products', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="product" name = "product[]", multiple = 'multiple'>
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


        $( "#caterer " ).on( "change", function() {
            var caterer_id = $(this).val();
            if(caterer_id != "")
                $.ajax({
                    type: "GET",
                    url: BASE_URL+'/admin/packages/create/'+caterer_id,
                    success : function(data){
                        $( "#product" ).html('');
                        $( "#product" ).select2({
                            data : data
                        })
                    },
                    error: function(error){
                        console.log(error);
                    }
                });
        });

        $( "#product " ).on( "select2:select", function(e) {
//            console.log(e);
            var products = $(this).val();
//            var product_name = $('').text();
            products = $( "#product " ).select2('data');
            if(products != "") {
                $('.ul_current' ).html('');
                $.each(products, function( index, value ) {
                    console.log(value );
                    $('.ul_current').append($('<li>' +
                            '<label >' + value.text + '</label>' +
                            '<input type="number" name="product_count.' + value.id + '">' +
                            '</li>'));
                });
            }
        });
    </script>
@endsection
