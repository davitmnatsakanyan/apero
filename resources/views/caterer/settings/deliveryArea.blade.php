@extends ('caterer/layout/index')
@section('content')
    <div style="margin-top: 50px">
        @include('layouts/messages')
        <h2>Add delivery area</h2>
        {!! Form::open(['url' => '/caterer/settings/add','method'=>'post','class' => 'form-horizontal']) !!}

        <div class="form-group {{ $errors->has('zip_codes') ? 'has-error' : ''}}">
            {!! Form::label('zip_codes', 'Zip Codes', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                <div class="col-sm-6">
                    <select class="selectpicker form-control" id="zip_codes" name="zip_codes[]" multiple="multiple" data-placeholder="select zip code">
                        @foreach($zip_codes as $zip_code)
                            <option value="{{ $zip_code->id }}">{{$zip_code->ZIP . "  " . $zip_code->city}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('caterer', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        <hr>
        <h2>Delivery areas</h2>
        <div style = "width: 300px">
        <table class="table table-bordered table-striped table-hover" >
            <tbody>
            @foreach($delivery_areas as $delivery_area)
                <tr>
                    <th>{{$delivery_area->ZIP . "  " . $delivery_area->city}}</th>
                    <td><a href="{{ url('caterer/settings/remove' ,$delivery_area->id )}}"
                           class="btn btn-danger btn-xs" title="Remove from delivery areas"><span
                                    class="glyphicon glyphicon-trash" aria-hidden="true"/></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
    </div>

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
</script>
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

