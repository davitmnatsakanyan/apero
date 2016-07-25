@extends ('caterer/layout/index')

@section('content')
    <div style="margin-top: 70px;margin-left:50px; width: 800px">
        @include ('layouts/messages')
        <div><h2>Orders</h2></div>
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
                        <td><a href = "{{ url('caterer/order/show', $order->id) }}">{{ $order->id }} </a></td>
                        <td>{{ $order->delivery_address . ", " .
                                           $order->delivery_zip . ", ".
                                           $order->delivery_city . ", ".
                                           $order->delivery_country . ", "
                                     }}</td>
                        <td>{{ $order->delivery_time }}</td>
                        <td> {{ $order->status}}</td>
                        <td>
                            <a  class = "change" href="#"
                                data-toggle="modal"
                                data-target="#changeOrderStatus"
                                data-status= "{{$order->status}}"
                                data-id="{{$order->id}}">Change Status</a></td>
                        </td>
                        @include('caterer/order/modals/changeStatus')
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>

@stop

@section('js')
    <script>
        $(".change").on("click",function(){
            var id = $(this).data('id');
            var status = $(this).data('status');

            $("#"+status).attr('checked', true);
            $('input[name="order_id"]').val(id);
        });
    </script>
    @stop