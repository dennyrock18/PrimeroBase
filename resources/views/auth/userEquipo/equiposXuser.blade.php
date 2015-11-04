@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Listado de Equipos del usuario {{$user->fullname}}</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <a href="{{route('foraddequipouser', $user->id)}}"><img
                                    src="{{asset('imag/equipo.png')}}"
                                    title="Agregar un equipo"></a> <a href="#"><img
                                    title="Informe en pdf"
                                    src="{{asset('imag/pdf.png')}}"></a>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @include('partials.message')
                        <div class="dataTable_wrapper">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Id_BD</th>
                                    <th>Numero de Serie</th>
                                    <th>Modelo</th>
                                    <th>Tipo de Equipo</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($user->equipo as $equipo)
                                    <tr class="gradeA" data-id="{{$equipo->id}}">
                                        <td>{{$equipo->id}}</td>
                                        <td>{{$equipo->s_n}}</td>
                                        <td>{{$equipo->model}}</td>
                                        <td>{{$equipo->type->tipoequipo}}</td>
                                        <td class="col-lg-2"><center><a href="{{route('admin.equipo.edit', $equipo->id)}}"><img
                                                        src="{{asset('imag/Edit.png')}}" title="Editar a {{$equipo->s_n}}"></a> || <a
                                                    href="#" class="btn-delete"><img title="Eliminar a {{$equipo->s_n}}"
                                                                                     src="{{asset('imag/delete.png')}}"></a></center></td>
                                    </tr>
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
    {!! Form::open(['route' => ['admin.equipo.destroy', ':EQUIPO_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}

    {!! Form::close() !!}

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

    <script>
        $(document).ready(function () {
            $(document).on('click', '.btn-delete',function (e) {
                e.preventDefault()

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form = $('#form-delete');
                var url = form.attr('action').replace(':EQUIPO_ID', id);
                var data = form.serialize();

                if (confirm("Realmente decea eliminar este registro ?")) {
                    $.post(url, data, function (result) {
                        alert(result.message);
                        row.fadeOut();
                    }).fail(function () {
                        alert('El equipo no fue eliminado');
                        row.show();
                    });
                }
            });
        });

    </script>



@stop
