@extends ('caterer/layout/index')

@section('content')
    <div style="margin-top: 70px;margin-left:50px; width: 800px">
        @include ('layouts/messages')
        <div><h2>Simple Products</h2></div>
        <div><h3><a href="{{url('caterer/product/single/add')}}">Add Single Product</a></h3></div>
        @foreach($kitchens as $kitchen)
            @if(count($kitchen->menus)>0)
          <h2>{{ $kitchen->name }}</h2>
        @foreach($kitchen->menus as $key => $menu)
                @if(count($menu->products)>0)
        <h3>{{ $menu->name }}</h3>
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
                @foreach($menu->products as $key => $product)
                   <tr>
                       <td>{{ $key+1 }}</td>
                       <td>{{ $product->name}}</td>
                       <td>{{ $product->ingredients}}</td>
                       <td>{{ $product->price}}</td>
                       <td>
                           <a href="{{ url('caterer/product/single/view' , $product->id) }}">View</a> |
                           <a href="{{ url('caterer/product/single/edit' , $product->id) }}">Edit</a> |
                           <a href="#" data-toggle="modal" data-target="#myModal">Delete</a>
                       </td>
                       @include('caterer/product/single/modals/delete')
                   </tr>
                @endforeach
            </tbody>
        </table>
                @endif
        @endforeach
            @endif
            @endforeach
    </div>

@stop