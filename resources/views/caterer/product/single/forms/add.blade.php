<h1>Create New Product</h1>
<hr/>

{!! Form::open(['url' => '/caterer/product/single/add', 'class' => 'form-horizontal' ,'files' =>true]) !!}

<div class="form-group {{ $errors->has('kitchen') ? 'has-error' : ''}}">
    {!! Form::label('kitchen', 'Kitchen', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        <div class="col-sm-6">
            <select class="selectpicker form-control" id="kitchen" name="caterer">
                <option value="">Select kitchen</option>
                @foreach($kitchens as $kitchen)
                    <option value="{{ $kitchen->id }}">{{$kitchen->name}}</option>
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
            <select class="selectpicker form-control" id="menu" name="menu">
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

<div class="form-group price {{ $errors->has('price') ? 'has-error' : ''}}">
    {!! Form::label('price', 'Price (EUR)', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::number('price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('subproduct', 'Costumize', ['class' => 'col-sm-3 control-label']) !!}
    <button type="button" class="btn btn-success btn-xs">
     <span class="glyphicon glyphicon-plus" aria-hidden="true" id = "costumize_button"/>
    </button>
    <ul class="col-sm-6" id = "ul_costumize" style="list-style-type: none">

    </ul>
</div>

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>

{!! Form::close() !!}


</div>
</div>