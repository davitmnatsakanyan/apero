@extends ('user/layout/index')
@section('content')
<div style="width: 600px; margin-top: 70px">
@include('layouts/messages')
@if(!$orders->isEmpty())
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Caterer</th>
            <th>Products</th>
            <th>Total Cost</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $key =>$order)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $order->caterer->company }}</td>
                    <td>
                        @foreach($order->products as $product)
                           {{ $product->name . ", "}}
                            @endforeach

                    </td>
                    <td>{{ $order->total_cost}}</td>
                    <td>
                        {{ $order->status }}
                    </td>
                    {{--@include('caterer/product/single/modals/delete')--}}
                </tr>
        @endforeach
        </tbody>
    </table>
    @else
    No Orders to show
@endif
</div>
@stop


