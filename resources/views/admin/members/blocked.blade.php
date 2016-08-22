@extends('admin.layout.index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts.messages')
            <h1>Members <a href="{{ url('/admin/members/create') }}" class="btn btn-primary btn-xs" title="Add New Member"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
            <div class="table">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th> Name </th>
                        <th> Address </th>
                        <th> Pobox </th>
                        <th> Admin </th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    {{-- */$x=0;/* --}}
                    @foreach($members as $item)
                        {{-- */$x++;/* --}}
                        <tr>
                            <td>{{ $x }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->address }}</td>
                            <td>{{ $item->pobox }}</td>
                            <td>{{ $item->admin }}</td>
                            <td>
                                <a href="{{ url('/admin/members/active', $item->id ) }}" class="btn btn-success btn-xs"
                                   title="Block Caterer"><span class="glyphicon glyphicon-ok-sign" aria-hidden="true"/></a>

                                {!! Form::open([
                                    'method'=>'DELETE',
                                    'url' => ['/admin/members', $item->id],
                                    'style' => 'display:inline'
                                ]) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Member" />', array(
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-xs',
                                        'title' => 'Delete Member',
                                        'onclick'=>'return confirm("Confirm delete?")'
                                ))!!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrapper"> {!! $members->render() !!} </div>
                <a href="{{ url('/admin/members') }}" class="btn btn-success btn-xs" title="View Product">
                    Active users <span class="glyphicon  glyphicon-list-alt" aria-hidden="true"/></a>
            </div>
        </div>
    </div>
@endsection
