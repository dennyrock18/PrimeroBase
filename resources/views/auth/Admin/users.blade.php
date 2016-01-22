@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Listado de Usuarios</h3>
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
                            <p><a title="Agregar Usuario" href="{{route('admin.user.create')}}" class="btn btn-primary"><i
                                            class="fa fa-plus-circle fa-fw"></i>Agregar Usuario</a></p>
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
                                    @if(isNotAdmin($user->role))
                                        @if($user->registration_token=="")
                                            <tr class="gradeA" data-id="{{$user->id}}">
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->fullname}}</td>
                                                <td>{{$user->id_user}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->phone}}</td>
                                                <div class="center">

                                                <td><p class="text-center"><a href="{{route('detailsUser', $user->id)}}"><img
                                                                src="{{asset('imag/Edit.png')}}"
                                                                title="Detalle de {{$user->fullname}}"></a> || <a
                                                            href="{{route('admin.user.edit', $user->id)}}"><img
                                                                src="{{asset('imag/Edit.png')}}"
                                                                title="Editar a {{$user->fullname}}"></a> || <a
                                                            href="#" class="btn-delete"><img
                                                                title="Eliminar {{$user->fullname}}"
                                                                src="{{asset('imag/delete.png')}}"></a>

                                                    @if($user->terminado != 0 && $user->fecha_entrega == null)
                                                            <!-- Button trigger modal -->
                                                    || <button type="button" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#myModal{{$user->id}}"><i data-toggle="tooltip" data-placement="top" title="Calendario" class="fa fa-calendar"></i></button>
                                                        {!! Form::open(['route' => ['fechaEntrega',$user], 'method' => 'PUT']) !!}
                                                            @include('auth.Admin.partials.modalUser')
                                                        {!! Form::close()!!}
                                                    </p></td>
                                                </div>
                                                @endif

                                            </tr>
                                        @endif
                                    @endif
                                @endforeach

                                </tbody>
                            </table>

                            {!! Form::open(['route' => ['admin.user.destroy', ':USER_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}

                            {!! Form::close() !!}
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
            @include('partials.datepicker')
        });
    </script>

    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete', function (e) {
                e.preventDefault()

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form = $('#form-delete');
                var url = form.attr('action').replace(':USER_ID', id);
                var data = form.serialize();


                if (confirm("Realmente decea eliminar este registro ?")) {
                    $.post(url, data, function (result) {
                        alert(result.message);
                        row.fadeOut();
                    }).fail(function () {
                        alert('El usuario no fue eliminado, Tiene elementos asociados a el');
                        row.show();
                    });
                }


            });
        });

    </script>



@stop
