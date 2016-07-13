@extends ('caterer/layout/index')

@section('content')
    <div style="margin-top: 70px;margin-left:50px; width: 800px">
        @include ('layouts/messages')
        <div><h2>Simple Products</h2></div>
        <div><h3><a href="{{url('caterer/product/single/add')}}">Add Single Product</a></h3></div>
        @foreach($kitchens as $key =>$kitchen)
          <h2><a href = "{{ url('caterer/product/kitchens#kitchen_' . $key ) }}">{{$kitchen['name'] }}</a></h2>
        @foreach($kitchen as $key => $menu)
            @if($key != 'name')
        <h3>{{ $menu['name']}}</h3>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Ingredients</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menu as $key1 => $product)
                @if($key1 !== 'name')
                    <tr>
                       <td>{{ $key1+1 }}</td>
                       <td>{{ $product->name}}</td>
                       <td>{{ $product->ingredinets}}</td>
                       <td>
                           <a href="{{ url('caterer/product/single/view' , $product->id) }}">View</a> |
                           <a href="{{ url('caterer/product/single/edit' , $product->id) }}">Edit</a> |
                           <a href="#" data-toggle="modal" data-target="#myModal">Delete</a>
                       </td>
                       @include('caterer/product/single/modals/delete')
                   </tr>
                   @endif
                @endforeach
            </tbody>
        </table>
                @endif
        @endforeach
            @endforeach
    </div>

@stop