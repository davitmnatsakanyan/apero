@extends('caterer/layout/index')
@section('css')
@stop
@section('content')
    <div style="margin-top: 70px;margin-left:50px; width: 800px">
        <h3>{{ $package['name'] }}</h3>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Product Count</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($package['products'] as $key => $product)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td><a href = "{{ url('caterer/product/single/view',$product['id'])}} ">{{ $product['name'] }}</a></td>
                    <td>{{ $product['pivot']['product_count']}}</td>
                    <td>
                        <a href="{{url('caterer/product/package/edit-single',$product['id'])}}">Edit</a> |
                        <a href="{{ url('caterer/prodct/package/remove-single',$product['id'] )}}">Remove</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @include('caterer/product/package/forms/add')
    </div>
@stop