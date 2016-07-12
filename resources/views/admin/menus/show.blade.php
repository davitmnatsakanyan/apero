@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Menu {{ $menu->id }}
                <a href="{{ url('admin/menus/' . $menu->id . '/edit') }}" class="btn btn-primary btn-xs"
                   title="Edit Menu"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                <a href="{{ url('/admin/menus/' . $menu->id . '/block') }}"
                   class="btn btn-warning btn-xs" title="Block Menu"><span
                            class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>
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
            <img src="{{url('images/menus/' . $menu->avatar)}}", alt="Mountain View" style="width:304px;height:228px;">
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
                        <th> Kitechens</th>
                        <td>
                        @foreach($menu->kitchens as $kitchen)
                        <a href = "{{ url('admin/kitchens/' . $kitchen->id) }}">{{ $kitchen->name }} </a>
                            @endforeach
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
