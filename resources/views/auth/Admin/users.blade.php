@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Listado de Usuarios</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Usuarios
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @include('partials.message')
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Id_BD</th>
                                    <th>Nombre Completo</th>
                                    <th>ID User</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    @if(auth()->user()->id != $user->id )
                                        <tr class="gradeA" data-id="{{$user->id}}">
                                            <td>{{$user->id}}</td>
                                            <td>{{$user->fullname}}</td>
                                            <td>{{$user->id_user}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->phone}}</td>
                                            <td><a href="{{route('detailsUser', $user->id)}}"><img
                                                            src="{{asset('imag/Edit.png')}}"></a> || <a
                                                        href="#"><img src="{{asset('imag/delete.png')}}"></a> ||
                                                @if($user->terminado != 0)
                                                    <a href="#"><img src="{{asset('imag/forudaa.png')}}"></a>
                                                @else

                                                    <a class="btn-delete"
                                                       href="{{route('terminar',$user->id)}}"><img
                                                                src="{{asset('imag/noterminado.png')}}"></a></td>
                                            @endif

                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>

    @stop

    @section('scripts')

            <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function () {
            $('#dataTables-example').DataTable({
                responsive: true
            });
        });
    </script>



@stop
