@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h1>Edit Kitchen {{ $kitchen->id }}</h1>

            {!! Form::model($kitchen, [
                'method' => 'PATCH',
                'url' => ['/admin/kitchens', $kitchen->id],
                'class' => 'form-horizontal'
            ]) !!}


            <div class="form-group {{ $errors->has('menu') ? 'has-error' : ''}}">
                {!! Form::label('menu', 'Menu', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="menu" name="menu[]" multiple="multiple">
                        @foreach($menus as $menu)
                            <option value="{{ $menu['id'] }}" {{ $menu['belongs']? 'selected' :'' }}>{{$menu['name']}}</option>
                        @endforeach

                    </select>
                    {!! $errors->first('menu', '<p class="help-block">:message</p>') !!}
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
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection