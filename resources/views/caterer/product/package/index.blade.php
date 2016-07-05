@extends ('caterer/layout/index')
@section ('content')
    <div style="margin-top: 70px;margin-left:50px; width: 800px">
        <h1>Packages</h1>
        <h3><a href = "{{ url('caterer/product/package/create') }}">Add Package</a></h3>
        @foreach($packages as  $package)
            <h3>{{ $package['name'] }}</h3>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Product Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($package['products'] as $key => $product)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td><a href = "{{ url('caterer/product/single/view',$product['id'])}} ">{{ $product['name'] }}</a></td>
                        <td>{{ $product['pivot']['product_count']}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

           <div>
               <h4>Actions</h4>
               <a href = " {{ url('caterer/product/package/edit',$package['id']) }}">Edit </a>|
               <a href = " {{ url('caterer/product/package/delete',$package['id']) }}">Delete </a>
           </div>
        @endforeach
    </div>
@stop
