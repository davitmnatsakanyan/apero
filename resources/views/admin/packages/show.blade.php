@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1> {{ $package->name }}
                <a href="{{ url('admin/packages/' . $package->id . '/edit') }}" class="btn btn-primary btn-xs"
                   title="Edit Package"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                <a href="{{ url('/admin/packages/' . $package->id . '/block') }}"
                   class="btn btn-warning btn-xs" title="Block Product"><span
                            class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/packages', $package->id],
                    'style' => 'display:inline'
                ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Package',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
                {!! Form::close() !!}
            </h1>
            <div class="table-responsive">
                <img src="{{url('images/packages/' . $package->avatar)}}" , alt="Mountain View"
                     style="width:304px;height:228px;">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $package->id }}</td>
                    </tr>
                    <tr>
                        <th> Name</th>
                        <td> {{ $package->name }} </td>
                    </tr>
                    <tr>
                        <th> Caterer Id</th>
                        <td>
                            <a href="{{ url('admin/caterers' ,$package->caterer_id) }}">{{ $package->caterer->company }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Price (EUR)</th>
                        <td>{{ $package->price }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive">
                <h2>Package Products</h2>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Product Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($package->products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td> <a href = " {{ url('admin/products' ,$product->id) }}">{{ $product->name }} </a> </td>
                            <td> {{ $product->pivot->product_count}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
