@extends ('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')
            <div><h2> Active Orders</h2></div>
            @if(!$orders->isEmpty())
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Delivery Address</th>
                        <th>Delivery Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $key =>$order)
                        <tr>
                            <td><a href="{{ url('admin/orders', $order->id) }}">{{ $order->id }}</a></td>
                            <td>{{ $order->delivery_address . ", " .
                                           $order->delivery_zip . ", ".
                                           $order->delivery_city . ", ".
                                           $order->delivery_country . ", "
                                     }}</td>
                            <td>{{ $order->delivery_time }}</td>
                            <td> {{ $order->status}}</td>
                            <td>
                                <a class="change" href="#"
                                   data-toggle="modal"
                                   data-target="#changeOrderStatus"
                                   data-status="{{$order->status}}"
                                   data-id="{{$order->id}}">Change Status</a>|
                                <a href="{{ url('/admin/orders/' . $order->id . '/block') }}"
                                   class="btn btn-warning btn-xs" title="Block Product"><span
                                            class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>
                                <a href="{{ url('/admin/orders/delete',  $order->id) }}"
                                   class="btn btn-danger btn-xs" title="Delete Product"><span
                                            class="glyphicon glyphicon-trash" aria-hidden="true"/></a>
                            </td>
                            </td>
                            @include('admin/order/modals/changeStatus')
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <div class="pagination-wrapper"> {!! $orders->render() !!} </div>
            <a href="{{ url('/admin/orders/blocked') }}" class="btn btn-success btn-xs" title="View Product">
                Blocked Orders <span class="glyphicon  glyphicon-list-alt" aria-hidden="true"/></a>
        </div>
    </div>

@stop

@section('js')
    <script>
        $(".change").on("click", function () {
            var id = $(this).data('id');
            var status = $(this).data('status');
            $("#" + status).closest('span').addClass('checked');
            $("#" + status).attr('checked',true);
            $('input[name="order_id"]').val(id);
        });
    </script>
@stop