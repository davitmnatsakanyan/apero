{!! Form::open(['url' => url('caterer/product/single/add'), 'method' => 'post'])!!}
<div class="form-group">
    {!! Form::label('name','Product Name')!!}
    {!! Form::text('name',NULL, ['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('ingredients','Ingredients')!!}
    {!! Form::textarea('ingredients',NULL, ['class' => 'form-control'])!!}
</div>
<div class="form-group">
    {!! Form::label('pobox','Price(EUR)')!!}
    {!! Form::text('price',NULL, ['class' => 'form-control'])!!}
</div>
<div>
{!! Form::submit('Add',['class' => 'btn btn-primary'])!!}
</div>
{!! Form::close() !!}