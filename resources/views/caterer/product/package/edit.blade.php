@extends('caterer/layout/index')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@stop
@section('content')
    <div style="margin-top: 70px;margin-left:50px; width: 800px">
        @include ('layouts/messages')

        <h1>Edit  {{ $package->name }}</h1>

        {!! Form::model($package, [
            'method' => 'PATCH',
            'url' => ['/caterer/product/package', $package->id],
            'class' => 'form-horizontal',
            'id' => 'main_form',
            'files' =>true,
        ]) !!}

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
                        background-image: url( '{{ url('images/packages/' . $package->avatar)}}' );
                        -webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .3)"></div>
            </div>
        </div>

        <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}">
            {!! Form::label('avatar', 'Avatar', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::file('avatar', ['class' => 'form-control']) !!}
                {!! $errors->first('avatar', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
            {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
                {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group {{ $errors->has('product') ? 'has-error' : ''}}">
            {!! Form::label('product', 'Products', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <select class="selectpicker form-control" id="product" name = "product[]", multiple = 'multiple'>
                    @foreach($products as $product)
                        @if(!$product['belong'])
                            <option value="{{ $product->id }}" }}>{{$product->name}}</option>
                        @endif
                    @endforeach
                </select>
                {!! $errors->first('product', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <ul class="ul_current" style = "list-style-type: none" >
        </ul>
        {!! Form::close() !!}

        <div class="table-responsive">
            <h2>Package Products</h2>
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Product Count</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($package->products as $product)
                    <tr id="product_raw_{{ $product->id }}">
                        <td>{{ $product->id }}</td>
                        <td> <a href = " {{ url('admin/products' ,$product->id) }}">{{ $product->name }} </a> </td>
                        <td id="product_{{ $product->id }}"> {{ $product->pivot->product_count}}</td>
                        <td>

                            <form class="remove_product" method="POST" action="{{ url('caterer/product/package/product/'.$product->id) }}" style="display: inline">
                                {{  csrf_field() }}
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="package" value="{{ $package->id }}">
                                <button type="submit" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-trash"></span></button>
                            </form>

                            <a class="btn btn-primary btn-xs edit_product_count" data-package_id="{{ $package->id }}" data-product_id="{{ $product->id }}" data-product_name="{{ $product->name }}" data-toggle="modal" data-product_count="{{ $product->pivot->product_count }}" href="#edit_product_count"><span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Edit Count" /></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control', 'form'=> 'main_form']) !!}
            </div>
        </div>


        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
    </div>
    @include('caterer.product.package.modals.edit_product_count')
    </div>
@stop




@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


    <script>

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

        $('.edit_product_count').on('click', function(){
            var count = $(this).data('product_count');
            var product_name = $(this).data('product_name');
            var product_id = $(this).data('product_id');
            var package_id = $(this).data('package_id');

            $('input[name="count"]').val(count);
            $('.product_name').html(product_name);
            $('input[name="product"]').val(product_id);
            $('input[name="package"]').val(package_id);
        })

        $("#form_count").submit(function(e) {
            e.preventDefault();
            var postData = $(this).serialize();
            var formURL = $(this).attr("action");
            $.ajax(
                    {
                        url: formURL,
                        type: "POST",
                        dataType: 'JSON',
                        data: postData,
                        success: function (data) {
                            if(data.success == 1){
                                $('#edit_product_count').modal('hide');
                                $('#product_'+data.product).html(data.count);

                            }
                        },
                        error: function(error){
                            alert(error);
                        }
                    });

        });

        $(".remove_product").submit(function(e) {
            e.preventDefault();
            var postData = $(this).serialize();
            var formURL = $(this).attr("action");
            $.ajax(
                    {
                        url: formURL,
                        type: "POST",
                        dataType: 'JSON',
                        data: postData,
                        success: function (data) {
                            if(data.success == 1){

                                $('#product_raw_'+data.product).html('');

                            }
                        },
                        error: function(error){
                            alert(error);
                        }
                    });

        });



    </script>
@endsection