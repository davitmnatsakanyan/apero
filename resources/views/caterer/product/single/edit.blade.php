@extends ('caterer/layout/index')
@section ('content')
    <div style=" margin-top: 50px; margin-left: 20px;">
        @include ('layouts/messages')
        @include('caterer/product/single/forms/edit')
    </div>
@stop

@section ('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">




        $(function() {
            $("#avatar").on("change", function()
            {
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        $("#imagePreview").css("background-image", "url("+this.result+")");
                    }
                }
            });
        });



        var i=0;
        $("#customize_button").on("click", function () {
            $('.price').addClass('hidden');
            $('#ul_customize').append($('<li>' +
                    '<label>Name</label><input type="text" name="customize['+i+']['+'name'+']" class = "form-control" >' +
                    '<label>Price</label><input type="text" name="customize[' + i++ +']['+'price'+']" class = "form-control" >' +
                    '<a  class="btn btn-danger btn-xs unselect_button">' +
                    '<span class="glyphicon glyphicon-minus" aria-hidden="true" />' +
                    '</a>' +
                    '</li>'));
        });


        $(document ).on( "click", ".unselect_button" , function() {
            console.log($('#ul_customize').find('li').length)
            if(($('#ul_customize').find('li').length - 1) == 0) {
                $('.price').removeClass('hidden');
            }
            $(this).closest('li').remove();
        });


        $(".edit").on("click",function(){
            var name = $(this).data('name');
            var price = $(this).data('price');
            var id = $(this).data('id');

           $('#updateSubproduct').find("input[name='name']").val(name);
           $('#updateSubproduct').find("input[name='price']").val(price);
            $('#updateSubproduct').find("input[name='id']").val(id);
        });

        $('.delete').on('click',function(){
            $('#deleteSubproduct').find("input[name='id']").val($(this).data('id'));
        });


    </script>


@stop



@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection