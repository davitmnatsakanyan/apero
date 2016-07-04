<h1>Edit {{ $product->name }}</h1>

{!! Form::model($product, [
    'method' => 'post',
    'url' => ['/caterer/product/single/edit', $product->id],
    'class' => 'form-horizontal',
    'files' => true,
]) !!}



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
<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::number('price', null, ['class' => 'form-control', 'required' => 'required','step'=>"any"]) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
{!! Form::close() !!}
