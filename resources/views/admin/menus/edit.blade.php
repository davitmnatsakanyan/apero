@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            @include ('layouts/messages')

            <h1>Edit Menu {{ $menu->id }}</h1>

            {!! Form::model($menu, [
                'method' => 'PATCH',
                'url' => ['/admin/menus', $menu->id],
                'class' => 'form-horizontal'
            ]) !!}

            <div class="form-group {{ $errors->has('kitechen') ? 'has-error' : ''}}">
                {!! Form::label('kitechen', 'Kitechen', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker" id="kitchen" name = "kitchen">
                        @foreach($kitchens as $kitchen)
                            <option value="{{ $kitchen['id'] }}"  {{ $kitchen['id'] == $menu->kitchen->id ? 'selected' :'' }}>{{$kitchen['name']}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>



            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection