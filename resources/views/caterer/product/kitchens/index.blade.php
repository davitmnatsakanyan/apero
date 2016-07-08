@extends ('caterer/layout/index')
@section ('content')
    <div style="margin-top: 70px;margin-left:50px; width: 800px">
        <h1>Kitchens</h1>
        @include ('layouts/messages')
        <hr>
            <h3>Add Kitchen</h3>
        {!! Form::open(['url' => '/caterer/product/kitchens/add', 'class' => 'form-horizontal']) !!}
        <div class="form-group {{ $errors->has('kitchen') ? 'has-error' : ''}}">
            {!! Form::label('kitchen', 'Kitchen', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <select class="selectpicker form-control" id="kitchen" name = "kitchen[]" multiple="multiple">
                    @foreach($adding_kitchens as $kitchen)
                        <option value="{{ $kitchen->id }}"  >{{$kitchen->name}}</option>
                    @endforeach
                </select>
                {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <hr>
        @foreach($kitchens as  $kitchen)
            <h3 id = {{"kitchen_" .  $kitchen->id }}>{{ $kitchen->name }}
                {!! Form::open([
                    'method'=>'post',
                    'url' => ['caterer/product/kitchens/delete', $kitchen->id],
                    'style' => 'display:inline'
                ]) !!}
                {!! Form:: hidden('_method' ,'delete') !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'title' => 'Delete Menu',
                        'onclick'=>'return confirm("Confirm delete?")'
                ))!!}

                {!! Form::close() !!}
            </h3>
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Menu Name</th>
                    <th>Product Count</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kitchen->menus as $key => $menu)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu -> product_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-2.2.4.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

    <script type="text/javascript">
        $('select').select2();
    </script>
@stop




