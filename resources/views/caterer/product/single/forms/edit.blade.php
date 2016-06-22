{!! Form::open(['url' => url('caterer/product/single/edit' ,$product['id'] ), 'method' => 'post'])!!}
<div class="form-group">
    {!! Form::label('name','Product Name')!!}
    {!! Form::text('name',$product['name'], ['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('ingredients','Ingredients')!!}
    {!! Form::textarea('ingredients',$product['ingredients'], ['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('pobox','Price(EUR)')!!}
    {!! Form::text('price',$product['price'], ['class' => 'form-control'])!!}
</div>
<div>
    {!! Form::submit('Edit',['class' => 'btn btn-primary'])!!}
</div>
{!! Form::close() !!}