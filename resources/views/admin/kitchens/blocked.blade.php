@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')
            <h1>Blocked kitchens</h1>
            <div class="table">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th> Name</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- */$x=0;/* --}}
                    @foreach($kitchens as $item)
                        {{-- */$x++;/* --}}
                        <tr>
                            <td>{{ $x }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <a href="{{ url('/admin/kitchens/' . $item->id . '/active') }}"
                                   class="btn btn-warning btn-xs" title="Block Caterer"><span
                                            class="glyphicon glyphicon-ok-sign" aria-hidden="true"/></a>
                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/kitchens', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Kitchen" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Kitchen',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ url('/admin/kitchens') }}" class="btn btn-success btn-xs" title="View Caterer">Active kitchens <span class="glyphicon  glyphicon-list-alt" aria-hidden="true"/></a>
            </div>
        </div>
    </div>
@endsection
