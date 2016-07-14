@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Edit {{ $product->name }}</h1>

            {!! Form::model($product, [
                'method' => 'PATCH',
                'url' => ['/admin/products', $product->id],
                'class' => 'form-horizontal',
                'files' => true,
            ]) !!}
           <h3>Optional information</h3>
            <div class="form-group {{ $errors->has('caterer') ? 'has-error' : ''}}">
                {!! Form::label('caterer', 'Caterer', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="caterer" name="caterer">
                        @foreach($caterers as $caterer)
                            <option value="{{ $caterer['id'] }}" {{ $caterer['id'] == $product->caterer->id ? 'selected' :'' }}>{{$caterer['company']}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('caterer', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('kitchen') ? 'has-error' : ''}}">
                {!! Form::label('kitchen', 'Kitchen', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="kitchen" name="kitchen">
                        @foreach($kitchens as $kitchen)
                            <option value="{{ $kitchen['id'] }}" {{ $kitchen['id'] == $product->kitchen->id ? 'selected' :'' }}>{{$kitchen['text']}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
                {!! Form::label('menu', 'Menu', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="menu" name="menu">
                        @foreach($menus as $menu)
                            <option value="{{ $menu['id'] }}" {{ $menu['id'] == $product->menu->id ? 'selected' :'' }}>{{$menu['text']}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            {{--<img src="{{url('images/products/' . $product->avatar)}}", alt="Mountain View" style="width:304px;height:228px;" id="avatar">--}}

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <div id="imagePreview" style="width: 120px;
                                                height: 120px;
                                                background-position: center center;
                                                background-size: cover;
                                                background-image: url( {{url('images/products/' . $product->avatar)}} );
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

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('ingredinets') ? 'has-error' : ''}}">
                {!! Form::label('ingredinets', 'Ingredinets', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('ingredinets', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('ingredinets', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            @if(count($product->subproducts)==0)
                <div class="form-group price {{ $errors->has('price') ? 'has-error' : ''}}">
                    {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
                    <div class="col-sm-6">
                        {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required','step'=>"any"]) !!}
                        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>
            @endif

            <h3>Add subproduct</h3>
            <div class="form-group">
                {!! Form::label('subproduct', 'Customize', ['class' => 'col-sm-3 control-label']) !!}
                <button type="button" class="btn btn-success btn-xs">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true" id = "customize_button"/>
                </button>
                <ul class="col-sm-6" id = "ul_customize" style="list-style-type: none">

                </ul>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            @if(count($product->subproducts)!=0)
                <hr>
                <h2>Subproducts</h2>
                <hr>
                <div style="width:600px;">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Subproduct_name</th>
                            <th>Subproduct price</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($product->subproducts as $key => $subproduct)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $subproduct->name }}</td>
                                <td>{{$subproduct->price }}</td>
                                <td> <a class = "edit" href="#" data-toggle="modal"
                                        data-target="#editSubproduct"
                                        data-name="{{$subproduct->name}}"
                                        data-price="{{$subproduct->price}}"
                                        data-id="{{$subproduct->id}}">Edit
                                    </a> |
                                    <a  class = "delete" href="#"
                                        data-toggle="modal"
                                        data-target="#deleteSubproductModal"
                                        data-id="{{$subproduct->id}}">Delete</a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    @include('admin/products/modals/edit')
    @include('admin/products/modals/deleteSubproduct')
@endsection


@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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




        var i=0;
        $("#customize_button").on("click", function () {
            $('.price').addClass('hidden');
            $('#ul_customize').append($('<li>' +
                    '<label>Name</label><input type="text" name="customize['+i+']['+'name'+']" class = "form-control" >' +
                    '<label>Price</label><input type="text" name="customize[' + i++ +']['+'price'+']" class = "form-control" >' +
                    '<a  class="btn btn-danger btn-xs unselect_button">' +
                    '<span class="glyphicon glyphicon-minus" aria-hidden="true" />' +
                    '</a>' +
                    '</li>'));
        });


        $(document ).on( "click", ".unselect_button" , function() {
            console.log($('#ul_customize').find('li').length)
            if(($('#ul_customize').find('li').length - 1) == 0) {
                $('.price').removeClass('hidden');
            }
            $(this).closest('li').remove();
        });




        $(".edit").on("click",function(){
            var name = $(this).data('name');
            var price = $(this).data('price');
            var id = $(this).data('id');

            $('#updateSubproduct').find("input[name='name']").val(name);
            $('#updateSubproduct').find("input[name='price']").val(price);
            $('#updateSubproduct').find("input[name='id']").val(id);
        });

        $('.delete').on('click',function(){
            $('#deleteSubproduct').find("input[name='id']").val($(this).data('id'));
        });


    </script>
@endsection