@extends ('caterer/layout/index')

@section('content')
    <div style="margin-top: 70px;margin-left:50px; width: 800px">
        @include ('layouts/messages')
        <div><h2>Simple Products</h2></div>
        <div><h3><a href="{{url('caterer/product/single/add')}}">Add Single Product</a></h3></div>
        @foreach($products as $key => $category)
        <h3>{{ $key }}</h3>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Ingredients</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                @foreach($category as $key => $product)
                   <tr>
                       <td>{{ $key+1 }}</td>
                       <td>{{ $product['name']}}</td>
                       <td>{{ $product['ingredients']}}</td>
                       <td>{{ $product['price']}}</td>
                       <td>
                           <a href="{{ url('caterer/product/single/view' , $product['id']) }}">View</a> |
                           <a href="{{ url('caterer/product/single/edit' , $product['id']) }}">Edit</a> |
                           <a href="{{ url('caterer/product/single/delete' , $product['id']) }}">Delete</a>
                       </td>
                   </tr>
                @endforeach
            </tbody>
        </table>
        @endforeach
    </div>
@stop