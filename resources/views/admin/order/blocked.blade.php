@extends ('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')
            <div><h2>Blocked Orders</h2></div>
            @if(!$orders->isEmpty())
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Delivery Address</th>
                        <th>Delivery Time</th>
                        <th>Status</th>
                        <th>Admin</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as  $order)
                        <tr>
                            <td><a href="{{ url('admin/orders', $order->id) }}">{{ $order->id }}</a></td>
                            <td>{{ $order->delivery_address . ", " .
                                           $order->delivery_zip . ", ".
                                           $order->delivery_city . ", ".
                                           $order->delivery_country . ", "
                                     }}
                            </td>
                            <td>{{ $order->delivery_time }}</td>
                            <td> {{ $order->status}}</td>
                            <td> {{ $order->admin->name }} </td>
                            <td>
                                <a  href="{{ url('admin/orders/activate' , $order->id) }}">Activate</a>
                                <a href="{{ url('/admin/orders/delete' , $order->id ) }}"
                               class="btn btn-danger btn-xs" title="Delete Order"><span
                                        class="glyphicon glyphicon-trash" aria-hidden="true"/></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif

            <div class="pagination-wrapper"> {!! $orders->render() !!} </div>
            <a href="{{ url('/admin/orders') }}" class="btn btn-success btn-xs" title="View Product">
                Active orders <span class="glyphicon  glyphicon-list-alt" aria-hidden="true"/></a>
        </div>
    </div>

@stop
