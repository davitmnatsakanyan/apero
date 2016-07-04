@extends ('caterer/layout/index')
@section ('content')
    <div style="width:300px; margin-top: 50px; margin-left: 20px;">
        @include('layouts/messages')
        <h1> {{ $product->name }}
            <a href="{{ url('caterer/product/single/edit/' . $product->id) }}" class="btn btn-primary btn-xs"
               title="Edit Product"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
            {!! Form::open([
                'method'=>'DELETE',
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
        <img src="{{url('images/products/' . $product->avatar)}}", alt="Mountain View" style="width:304px;height:228px;">
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
                <tr>
                    <th> Price</th>
                    <td> {{ $product->price }} </td>
                </tr>
                <tr>
                    <th> Menu</th>
                    <td> <a href = "{{url('admin/menus' , $product->menu_id )}}">{{ $product->menu }} </a></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@stop