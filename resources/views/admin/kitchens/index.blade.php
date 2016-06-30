@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Kitchens <a href="{{ url('/admin/kitchens/create') }}" class="btn btn-primary btn-xs"
                            title="Add New Kitchen"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
            <div class="table">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th> Name</th>
                        <th> Menus </th>
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
                                @foreach($item->menus as $menu)
                                    <a href="{{url( 'admin/menus/' . $menu->id) }}"> {{$menu->name}}</a>
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ url('/admin/kitchens/' . $item->id) }}" class="btn btn-success btn-xs"
                                   title="View Kitchen"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                                <a href="{{ url('/admin/kitchens/' . $item->id . '/edit') }}"
                                   class="btn btn-primary btn-xs" title="Edit Kitchen"><span
                                            class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                                <a href="{{ url('/admin/kitchens/' . $item->id . '/block') }}"
                                   class="btn btn-warning btn-xs" title="Block Caterer"><span
                                            class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>
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
                <div class="pagination-wrapper"> {!! $kitchens->render() !!} </div>
                <a href="{{ url('/admin/kitchens/blocked') }}" class="btn btn-success btn-xs" title="View Caterer">
                    Blocked Kitchens <span class="glyphicon  glyphicon-list-alt" aria-hidden="true"/></a>
            </div>
        </div>
    </div>
@endsection
