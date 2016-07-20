
<h3>Add Kitchen</h3>
{!! Form::open(['url' => 'admin/caterers/kitchens/add', 'class' => 'form-horizontal']) !!}
<div class="form-group {{ $errors->has('kitchen') ? 'has-error' : ''}}">
    {!! Form::label('kitchen', 'Kitchen', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        <select class="selectpicker form-control" id="kitchen" name="kitchen[]" multiple="multiple">
            @foreach($adding_kitchens as $kitchen)
                <option value="{{ $kitchen->id }}">{{$kitchen->name}}</option>
            @endforeach
        </select>
        {!! $errors->first('kitchen', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{!! Form::hidden('caterer_id',$caterer->id) !!}

<div class="form-group">
    <div class="col-sm-offset-3 col-sm-3">
        {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
    </div>
</div>
{!! Form::close() !!}
<hr>
<div style="width: 400px">
<table class="table table-bordered table-striped table-hover">
    <tbody>
    @foreach($caterer->kitchens as  $kitchen)
        <tr>
            <th> {{ $kitchen->name }}</th>
            <td>
                {!! Form::open([
                    'method'=>'post',
                    'url' => ['admin/caterers/' . $caterer->id . '/kitchen', $kitchen->id],
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
            </td>
        <tr>
    @endforeach
    </tbody>
</table>
</div>








