@extends('layouts/master')

@section('header')

    <link href="{{ asset('/admin/Dropzone/dropzone.css') }}" rel="stylesheet">

@stop

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Subir Foto de Perfil</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row col-lg-2 ">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Dropzone
                </div>
                <center>
                    <div class="panel-body text-center">
                        {!! Form::open(['route'=> 'subirFoto', 'method' => 'POST', 'files'=>'true', 'id' => 'my-dropzone' , 'class' => 'dropzone']) !!}
                        <div class="dz-message" style="height:10px;">
                            Drop your files here
                        </div>
                        <div class="dropzone-previews"></div>
                        <button type="submit" class="btn btn-success" id="submit">Save</button>
                        {!! Form::close() !!}
                    </div>
                </center>
            </div>
        </div>

        <!-- /.row -->
    </div>


@stop

@section('scripts')
    {!! Html::script('admin/js/Dropzone/dropzone.js') !!}

    <script>
        Dropzone.options.myDropzone = {
            autoProcessQueue: false,
            uploadMultiple: false,
            maxFilezise: 2,
            maxFiles: 1,

            init: function () {
                var submitBtn = document.querySelector("#submit");
                myDropzone = this;

                submitBtn.addEventListener("click", function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });
                this.on("addedfile", function (file) {
                    alert("file uploaded");
                });

                this.on("complete", function (file) {
                    myDropzone.removeFile(file);
                });

                this.on("success",
                        myDropzone.processQueue.bind(myDropzone)
                );
            }
        };
    </script>

@stop
