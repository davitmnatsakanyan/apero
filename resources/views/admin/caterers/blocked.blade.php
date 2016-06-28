@extends('admin/layout/index')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">

        <h1>Blocked Caterers</h1>
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>S.No</th><th> Company </th><th> Name </th><th> Address </th><th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($caterers as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->company }}</td><td>{{ $item->name }}</td><td>{{ $item->address }}</td>
                    <td>
                        <a href="{{ url('/admin/caterers/' . $item->id . '/active') }}" class="btn btn-success btn-xs"
                           title="Block Caterer"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"/></a>
                        {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['/admin/caterers', $item->id],
                        'style' => 'display:inline'
                        ]) !!}
                        {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Caterer" />', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Caterer',
                        'onclick'=>'return confirm("Confirm delete?")'
                        ))!!}
                        {!! Form::close() !!}
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection