@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Products <a href="{{ url('/admin/products/create') }}" class="btn btn-primary btn-xs"
                            title="Add New Product"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
            <div class="table">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th> Name</th>
                        <th> Ingredinets</th>
                        <th> Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- */$x=0;/* --}}
                    @foreach($products as $item)
                        {{-- */$x++;/* --}}
                        <tr>
                            <td>{{ $x }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->ingredinets }}</td>
                            <td>{{ $item->price }}</td>
                            <td>
                                <a href="{{ url('/admin/products/' . $item->id) }}" class="btn btn-success btn-xs"
                                   title="View Product"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                <a href="{{ url('/admin/products/' . $item->id . '/edit') }}"
                                   class="btn btn-primary btn-xs" title="Edit Product"><span
                                            class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                <a href="{{ url('/admin/products/' . $item->id . '/block') }}"
                                   class="btn btn-warning btn-xs" title="Block Menu"><span
                                            class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/products', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Product" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Product',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $products->render() !!} </div>
                <a href="{{ url('/admin/products/blocked') }}" class="btn btn-success btn-xs" title="View Product">
                    Blocked Products <span class="glyphicon  glyphicon-list-alt" aria-hidden="true"/></a>
            </div>
        </div>
    </div>
@endsection
