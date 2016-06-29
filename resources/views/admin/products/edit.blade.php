@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Edit Product {{ $product->id }}</h1>

            {!! Form::model($product, [
                'method' => 'PATCH',
                'url' => ['/admin/products', $product->id],
                'class' => 'form-horizontal',
                'files' => true,
            ]) !!}

            <div class="form-group {{ $errors->has('caterer') ? 'has-error' : ''}}">
                {!! Form::label('caterer', 'Caterer', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker" id="caterer" name="caterer">
                        @foreach($caterers as $caterer)
                            <option value="{{ $caterer['id'] }}" {{ $caterer['id'] == $product->caterer_id ? 'selected' :'' }}>{{$caterer['name']}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
                {!! Form::label('menu', 'Menu', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker" id="menu" name="menu">
                        @foreach($menus as $menu)
                            <option value="{{ $menu['id'] }}" {{ $menu['id'] == $product->menu_id ? 'selected' :'' }}>{{$menu['text']}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


            <img src="{{url('images/products/' . $product->avatar)}}", alt="Mountain View" style="width:304px;height:228px;" id="avatar">

            <div class="form-group {{ $errors->has('avatar') ? 'has-error' : ''}}" id="file_avatar">
                {!! Form::label('avatar', 'Avatar', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::file('avatar', ['class' => 'form-control', 'required' => 'required']) !!}
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
            <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
                {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
                </div>
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