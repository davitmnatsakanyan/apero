@extends ('templates/caterer/layout/index')
@section ('content')
    <div style="width:300px; margin-top: 50px; margin-left: 20px;">
        <div>Name  : {{$product['name']}}</div>
        <div>Ingredients : {{$product['ingredients']}}</div>
        <div>Price : {{$product['price']}}</div>
        <div>Created Date: {{$product['created_at']}}</div>
        <div>Updated Date : {{$product['updated_at']}}</div>
    </div>
@stop