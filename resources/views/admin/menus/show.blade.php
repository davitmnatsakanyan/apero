@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Menu {{ $menu->id }}
                <a href="{{ url('admin/menus/' . $menu->id . '/edit') }}" class="btn btn-primary btn-xs"
                   title="Edit Menu"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/menus', $menu->id],
                    'style' => 'display:inline'
                ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Menu',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
                {!! Form::close() !!}
            </h1>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $menu->id }}</td>
                    </tr>
                    <tr>
                        <th> Name</th>
                        <td> {{ $menu->name }} </td>
                    </tr>
                    <tr>
                        <th> Kitechen</th>
                        <td> {{ $menu->kitchen->name }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
