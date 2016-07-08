@extends ('user/layout/index')
@section('content')
    <div style="width: 300px; margin-top: 50px">
        @include('layouts/messages')
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <th>Name</th>
                <td>{{ $user->name }}</td>
            </tr>
            <tr>
                <th> Title </th>
                <td> {{ $user->title }} </td>
            </tr>
            <tr>
                <th> Address </th>
                <td> {{ $user->address }} </td>
            </tr>
            <tr>
                <th> Pobox </th>
                <td> {{ $user->pobox }} </td>
            </tr>
            <tr>
                <th> Zip </th>
                <td> {{ $zip['ZIP'] . "  " . $zip['city'] }} </td>
            </tr>
            <tr>
                <th> City </th>
                <td> {{ $user->city }} </td>
            </tr>
            <tr>
                <th> Country </th>
                <td> {{ $user->country }} </td>
            </tr>
            <tr>
                <th> Email </th>
                <td> {{ $user->email }} </td>
            </tr>
            <tr>
                <th> Phone </th>
                <td> {{ $user->phone }} </td>
            </tr>
            <tr>
                <th> Mobile </th>
                <td> {{ $user->mobile }} </td>
            </tr>

            </tbody>
        </table>
    </div>
@stop