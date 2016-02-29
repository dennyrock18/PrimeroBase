@extends('layouts/master')

@section('content')

        <!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Direccion del Usuario
                <small>{{ $users->fullname }}</small>
            </h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <p>
                        <i class="fa fa-home"></i> <abbr title="Direccion">D</abbr>: {{$users->Direccion}}</p>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <p><a href="{{route('delivery.index')}}" class="btn btn-primary"><i
                                    class="fa fa-hand-o-left fa-fw"></i>Atras</a></p>

                    <div class="row">
                        <!-- Map Column -->
                        <div class="col-md-8">
                            <!-- Embedded Google Map -->
                            {!! $marker['map_html'] !!}
                        </div>
                        <!-- Contact Details Column -->
                        <div class="col-lg-4">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    Informacion
                                </div>
                                <div class="panel-body">
                                    <p><i class="fa fa-laptop"></i>
                                        <abbr title="Cantidad de Equipos">M</abbr>: {{$users->total_equipo}}</p>

                                    <p><i class="fa fa-key"></i>
                                        <abbr title="ID">ID</abbr>: {{$users->id_user}}</p>

                                    <p><i class="fa fa-phone"></i>
                                        <abbr title="Phone">P</abbr>: {{$users->phone}}</p>

                                    <p><i class="fa fa-envelope-o"></i>
                                        <abbr title="Email">E</abbr>: <a href="{{$users->email}}">{{$users->email}}</a>
                                    </p>
                                </div>
                                <div class="panel-footer">
                                    {!! Form::open(['route' => 'delivery.store', 'method' => 'POST']) !!}
                                    {!! Field::hidden('id', $users->id) !!}
                                    {!! Form::submit('Realizado', ['class' => 'btn btn-outline btn-success']) !!}
                                    {!! Form::close()!!}
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

@stop

@section('scripts')
    <script type='text/javascript'>var centreGot = false;</script>
    {!! $marker['map_js'] !!}
@stop


