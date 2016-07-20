@extends('admin.layout.index')

@section('content')
<div class="page-content-wrapper">
    <div class="page-content">

    <h1>Member {{ $member->id }}
        <a href="{{ url('admin/members/' . $member->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Member"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/members', $member->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Member',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $member->id }}</td>
                </tr>
                <tr>
                    <th> Name </th>
                    <td> {{ $member->name }} </td>
                </tr>
                <tr>
                    <th> Address </th>
                    <td> {{ $member->address }} </td>
                </tr>
                <tr>
                    <th> Pobox </th>
                    <td> {{ $member->pobox }} </td>
                </tr>
                <tr>
                    <th> Zip </th>
                    <td> {{ $member->zip }} </td>
                </tr>
                <tr>
                    <th> City </th>
                    <td> {{ $member->city }} </td>
                </tr>
                <tr>
                    <th> Country </th>
                    <td> {{ $member->country }} </td>
                </tr>
                <tr>
                    <th> Email </th>
                    <td> {{ $member->email }} </td>
                </tr>
                <tr>
                    <th> Phone </th>
                    <td> {{ $member->phone }} </td>
                </tr>
                <tr>
                    <th> Mobile </th>
                    <td> {{ $member->mobile }} </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
