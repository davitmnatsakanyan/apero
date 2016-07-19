@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')
            <h1> {{ $order->id }}
                <a href="{{ url('/admin/orders/' . $order->id . '/block') }}"
                   class="btn btn-warning btn-xs" title="Block Order"><span
                            class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>
                <a href="{{ url('/admin/orders/delete' , $order->id ) }}"
                   class="btn btn-danger btn-xs" title="Delete Order"><span
                            class="glyphicon glyphicon-trash" aria-hidden="true"/></a>
            </h1>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <th>Caterer</th>
                        <td><a href="{{url('admin/caterers',  $order->caterer->id)}}">{{ $order->caterer->company }}</a>
                        </td>
                    </tr>
                    <tr>
                        <th>User</th>
                        <td><a href="{{url('admin/members',  $order->user->id)}}">{{ $order->user->name }}</a></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $order->email }}</td>
                    </tr>
                    <tr>
                        <th>Phone</th>
                        <td>{{ $order->phone }}</td>
                    </tr>
                    <tr>
                        <th>Mobile</th>
                        <td>{{ $order->mobile }}</td>
                    </tr>

                    <tr>
                        <th> Address</th>
                        <td> {{ $order->delivery_address . ", " . $order->delivery_zip . ", " . $order->delivery_city . ", " .  $order->delivery_country}} </td>
                    </tr>
                    <tr>
                        <th> Delivery Time</th>
                        <td> {{ $order->delivery_time}} </td>
                    </tr>
                    <tr>
                        <th>Total cost</th>
                        <td> {{ $order->total_cost }} </td>
                    </tr>
                    <tr>
                        <th>Payment Type</th>
                        <td>{{ $order->payment_type }}</td>
                    </tr>

                    @if($order->billing_address)
                        <tr>
                            <th>Billing Address</th>
                            <td>{{$order->billing_address }}</td>
                        </tr>
                    @endif
                    <tr>
                        <th>Status</th>
                        <td>{{ $order->status}}</td>
                    </tr>
                    <tr>
                        <th>Comment</th>
                        <td>{{ $order->comment ?  $order->comment:'No Comments' }}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
<h2>Products</h2>
            <hr/>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th> Product name</th>
                        <th> Amount </th>
                        <th> Comment </th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- */$x=0;/* --}}
                    @foreach($order->products as $item)
                        {{-- */$x++;/* --}}
                        <tr>
                            <td>{{ $x }}</td>
                            <td><a href="{{url('admin/products', $item->id)}}">{{ isset($item->subproduct)?$item->name ." " . $item->subproduct->name: $item->name }}</a></td>

                            <td>{{ $item->pivot->amount }}</td>
                            <td>{{ $item->pivot->description ?  $item->pivot->description : 'No Comment' }} </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

        </div>
    </div>
@endsection
