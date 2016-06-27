@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

    <h1>Caterer {{ $caterer->id }}
        <a href="{{ url('admin/caterers/' . $caterer->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Caterer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/caterers', $caterer->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Caterer',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $caterer->id }}</td>
                </tr>
                <tr><th> Company </th><td> {{ $caterer->company }} </td></tr><tr><th> Name </th><td> {{ $caterer->name }} </td></tr><tr><th> Address </th><td> {{ $caterer->address }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
        <div>
@endsection
