@extends('layouts/master')

@section('content')

        <!-- Page Content -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Detalle del Usuario
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
                        <abbr title="Direccion">D</abbr>: {{$users->Direccion}}</p>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <p><a href="{{route('admin.administrator.index')}}" class="btn btn-primary"><i
                                    class="fa fa-hand-o-left fa-fw"></i>Atras</a></p>
                    <div class="row">
                        <!-- Map Column -->
                        <div class="col-md-8">
                            <!-- Embedded Google Map -->
                            {!! $marker['map_html'] !!}
                        </div>
                        <!-- Contact Details Column -->
                        <div class="col-md-4">
                            <p><i class="fa fa-user"></i>
                                <abbr title="Rol en el Sistema">R</abbr>: {{$users->role}}</p>

                            <p><i class="fa fa-key"></i>
                                <abbr title="ID">ID</abbr>: {{$users->id_user}}</p>

                            <p><i class="fa fa-phone"></i>
                                <abbr title="Phone">P</abbr>: {{$users->phone}}</p>

                            <p><i class="fa fa-envelope-o"></i>
                                <abbr title="Email">E</abbr>: <a href="{{$users->email}}">{{$users->email}}</a>
                            </p>


                            <p>
                                <a class="btn btn-outline btn-success" href="{{route('admin.administrator.edit', $users->id)}}">Editar</a>
                            </p>

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


