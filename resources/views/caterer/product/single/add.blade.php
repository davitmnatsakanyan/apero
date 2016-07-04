@extends ('caterer/layout/index')
@section ('content')
    <div style=" margin-top: 50px; margin-left: 20px;">
        @include ('layouts/messages')
        @include('caterer/product/single/forms/add')
    </div>
@stop

@section ('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();


        $("#kitchen ").on("change", function () {
            var kitchen_id = $(this).val();
            if (kitchen_id != "")
                $.ajax({
                    type: "GET",
                    url: BASE_URL + '/caterer/product/single/getMenus/' + kitchen_id,
                    success: function (data) {
                        $("#menu").html('');
                        $("#menu").select2({
                            data: data
                        })
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
        });




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


    </script>


@stop



@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection