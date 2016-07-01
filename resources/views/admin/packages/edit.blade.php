@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Edit  {{ $package->name }}</h1>

            {!! Form::model($package, [
                'method' => 'PATCH',
                'url' => ['/admin/packages', $package->id],
                'class' => 'form-horizontal'
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
                            background-image: url( {{url('images/packages/' . $package->avatar)}} );
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

            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('Price', null, ['class' => 'form-control', 'required' => 'required']) !!}
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
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td> <a href = " {{ url('admin/products' ,$product->id) }}">{{ $product->name }} </a> </td>
                            <td> {{ $product->pivot->product_count}}</td>
                            <td>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/packages/' . $package->id . "/product/" . $product->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Package" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Package',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection



@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

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


        $( "#product " ).on( "select2:select", function() {
            var products = $(this).val();
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

        $( "#product " ).on( "select2:unselect", function() {
            alert('item unselected');
        });
</script>
@endsection