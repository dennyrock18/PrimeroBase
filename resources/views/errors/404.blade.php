@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><span class="glyphicon glyphicon-fire"></span> Error 404:</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Error
                    </div>
                    <div class="panel-body">
                        <h1> La paguina solicitada no existe
                        </h1>
                        <a href="{{route('login')}}">Pagina de Inicio</a>

                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /#page-wrapper -->

@stop

@section('scripts')
    @include('partials.scriptCountryPais')
@stop

