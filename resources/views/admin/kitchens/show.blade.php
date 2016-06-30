@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h1>Kitchen {{ $kitchen->id }}
                <a href="{{ url('admin/kitchens/' . $kitchen->id . '/edit') }}" class="btn btn-primary btn-xs"
                   title="Edit Kitchen"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                <a href="{{ url('/admin/kitchens/' . $kitchen->id . '/block') }}"
                   class="btn btn-warning btn-xs" title="Block Product"><span
                        class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>
                {!! Form::open([
                    'method'=>'DELETE',
                    'url' => ['admin/kitchens', $kitchen->id],
                    'style' => 'display:inline'
                ]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Kitchen',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}
                {!! Form::close() !!}
            </h1>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $kitchen->id }}</td>
                    </tr>
                    <tr>
                        <th> Name</th>
                        <td> {{ $kitchen->name }} </td>
                    </tr>

                    <tr>
                        <th> Menus</th>
                        <td>
                            @foreach($kitchen->menus as $menu)
                                <a href="{{url('admin/menus/' . $menu->id)}}">{{ $menu->name }} </a>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
