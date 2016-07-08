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

@if(count($product->subproducts)==0)
    <div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
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
@include('caterer/product/single/modals/edit')
@include('caterer/product/single/modals/deleteSubproduct')
