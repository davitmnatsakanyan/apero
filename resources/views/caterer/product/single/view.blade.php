@extends ('caterer/layout/index')
@section ('content')
    <div style="width:300px; margin-top: 50px; margin-left: 20px;">
        @include('layouts/messages')
        <h1> {{ $product->name }}
            <a href="{{ url('caterer/product/single/edit/' . $product->id) }}" class="btn btn-primary btn-xs"
               title="Edit Product"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
            {!! Form::open([
                'method'=>'get',
                'url' => ['caterer/product/single/delete/' . $product->id],
                'style' => 'display:inline'
            ]) !!}

            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Product',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
            {!! Form::close() !!}
        </h1>
        <img src="{{url('images/products/' . $product->avatar)}}", alt="Produktbild" style="width:304px;height:228px;">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <th> Name</th>
                    <td> {{ $product->name }} </td>
                </tr>
                <tr>
                    <th> Ingredinets</th>
                    <td> {{ $product->ingredinets }} </td>
                </tr>
                @if($product->price)
                <tr>
                    <th> Price</th>
                    <td> {{ $product->price }} </td>
                </tr>
                @endif
                <tr>
                    <th> Menu</th>
                    <td>{{ $product->menu->name }}</td>
                </tr>
                <tr>
                    <th> Kitchen</th>
                    <td> <a href = "{{url('caterer/product/kitchens#' , $product->kitchen->id )}}">{{ $product->kitchen->name }} </a></td>
                </tr>
                </tbody>
            </table>

            @if(count($product->subproducts)!=0)
          <h3>Costum products</h3>
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                @foreach($product->subproducts as $subproduct)
                    <tr>
                        <th>{{$subproduct->name}}</th>
                        <td>{{$subproduct->price}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                @endif


        </div>
    </div>
@stop