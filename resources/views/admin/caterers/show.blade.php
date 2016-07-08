@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h1>Caterer {{ $caterer->id }}
                <a href="{{ url('admin/caterers/' . $caterer->id . '/edit') }}" class="btn btn-primary btn-xs"
                   title="Edit Caterer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
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
            <img src="{{url('images/caterers/' . $caterer->avatar)}}" , alt="Mountain View"
                 style="width:304px;height:228px;">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $caterer->id }}</td>
                    </tr>
                    <tr>
                        <th> Company</th>
                        <td> {{ $caterer->company }} </td>
                    </tr>
                    <tr>
                        <th> Email</th>
                        <td> {{ $caterer->email }} </td>
                    </tr>
                    <tr>
                        <th> Address</th>
                        <td> {{ $caterer->address }} </td>
                    </tr>
                    <tr>
                        <th>Zip</th>
                        <td> {{ $caterer->address }} </td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td> {{ $caterer->city }} </td>
                    </tr>
                    <tr>
                        <th>Country</th>
                        <td> {{ $caterer->country }} </td>
                    </tr>
                    <tr>
                        <th> Phone</th>
                        <td> {{ $caterer->phone }} </td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td> {{ $caterer->description }} </td>
                    </tr>
                    <tr>
                        <th> Products origin</th>
                        <td> {{ $caterer->products_origin }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <hr>
            <h2>Contact person information</h2>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <td>{{ $contact_person->id }}</td>
                    </tr>
                    <tr>
                        <th> Prename</th>
                        <td> {{ $contact_person->prename }} </td>
                    </tr>
                    <tr>
                        <th> Name</th>
                        <td> {{ $contact_person->name }} </td>
                    </tr>
                    <tr>
                        <th> Title</th>
                        <td> {{ $contact_person->title }} </td>
                    </tr>
                    <tr>
                        <th> Email</th>
                        <td> {{ $contact_person->email }} </td>
                    </tr>
                    <tr>
                        <th> Mobile</th>
                        <td> {{ $contact_person->mobile }} </td>
                    </tr>
                    <tr>
                        <th> Phone</th>
                        <td> {{ $contact_person->phone }} </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <hr>
            <h2>Caterer Delivery Area</h2>
            <hr>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                    @foreach($caterer->zips as $zip)
                        <tr>
                            <th>{{$zip->ZIP . "  " . $zip->city}}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
