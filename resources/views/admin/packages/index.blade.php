@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h1>Packages <a href="{{ url('/admin/packages/create') }}" class="btn btn-primary btn-xs"
                            title="Add New Package"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
            <div class="table">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th> Name</th>
                        <th> Caterer Id</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- */$x=0;/* --}}
                    @foreach($packages as $item)
                        {{-- */$x++;/* --}}
                        <tr>
                            <td>{{ $x }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->caterer_id }}</td>
                            <td>
                                <a href="{{ url('/admin/packages/' . $item->id) }}" class="btn btn-success btn-xs"
                                   title="View Package"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                <a href="{{ url('/admin/packages/' . $item->id . '/edit') }}"
                                   class="btn btn-primary btn-xs" title="Edit Package"><span
                                            class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/packages', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Package" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Package',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $packages->render() !!} </div>
            </div>

        </div>
    </div>
@endsection
