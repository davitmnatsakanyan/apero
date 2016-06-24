{!!  Form::open(['url' => url('caterer/product/package/add'), 'method' => 'post'])!!}
 <div class="form-group">
    {!! Form::label('name','Package Name')!!}
    {!! Form::text('name',NULL, ['class' => 'form-control'])!!}
 </div>
   <select class="selectpicker" id="category">
      @foreach($categories as $category)
         <option value="{{ $category['id'] }}">{{$category['name']}}</option>
      @endforeach
   </select>
{!!  Form::select('product',[],null,['class'=>"selectpicker", 'id'=>"product"]) !!}
    <div class="form-group">
        {!! Form::label('product_count','Product Count')!!}
        {!! Form::text('product_count',NULL, ['class' => 'form-control'])!!}
    </div>
    <div>
        {!! Form::submit('Add',['class' => 'btn btn-primary'])!!}
    </div>
</div>
{!! Form::close() !!}
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("select").select2({
        });
    });

    $( "#category " ).on( "change", function() {
        var category_id = $(this).val();

        $.ajax({
            url: BASE_URL+'/caterer/product/package/products/'+category_id,
            success : function(data){
                $( "#product" ).html('');
                $( "#product" ).select2({
                    data : data
                })
            },
            error: function(error){
                console.log(error);
            }
        });
    });
</script>
