@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Product {{ $product->id }}
                <a href="{{ url('admin/products/' . $product->id . '/edit') }}" class="btn btn-primary btn-xs"
                   title="Edit Product"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/products', $product->id],
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
                        <td> <a href = "{{url('admin/menus/' , $product->menu_id )}}">{{ $product->menu }} </a></td>
                    </tr>
                    <tr>
                        <th> Caterer</th>
                        <td> <a href = "{{url('admin/caterers/' , $product->caterer_id )}}">{{ $product->caterer }} </a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
