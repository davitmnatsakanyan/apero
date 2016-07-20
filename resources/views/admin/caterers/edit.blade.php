@extends('admin/layout/index')

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">

            <h1>Edit Caterer {{ $caterer->id }}</h1>


            <ul class="nav nav-tabs" id="myTabs">
                <li role="presentation" class="active">
                    <a href="#common_information" aria-controls="common_information" role="tab" data-toggle="tab">Common information</a>
                </li>
                <li role="presentation">
                    <a href="#contact_person" aria-controls="contact_person" role="tab" data-toggle="tab">Contact person</a>
                </li>
                <li role="presentation">
                    <a href="#delivery_area" aria-controls="delivery_area" role="tab" data-toggle="tab">Delivery area</a>
                </li>
                <li role="presentation">
                    <a href="#kitchens" aria-controls="kitchens" role="tab" data-toggle="tab">Kitchens</a>
                </li>
            </ul>



            <div class="tab-content">
                @include('layouts.messages')
                <div role="tabpanel" class="tab-pane active" id="common_information">
                    @include('admin/caterers/forms/_form')
                </div>
                <div role="tabpanel" class="tab-pane" id="contact_person">
                    @include('admin/caterers/forms/contact_person')
                </div>
                <div role="tabpanel" class="tab-pane" id="delivery_area">
                    @include('admin.caterers.items.delivery_area')
                </div>
                <div role="tabpanel" class="tab-pane" id="kitchens">
                    @include('admin.caterers.items.kitchens')
                </div>
            </div>
        </div>
    </div>
@endsection


@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection


@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();



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