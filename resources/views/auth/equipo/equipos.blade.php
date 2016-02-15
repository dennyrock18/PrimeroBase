@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Listado de Equipos</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading ">
                        <a href="{{route('pfdequipos')}}" target="_blank"><img
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
                                    <th class="col-lg-1">Id_BD</th>
                                    <th class="col-lg-2">Numero de Serie</th>
                                    <th class="col-lg-2">Modelo</th>
                                    <th class="col-lg-2">Tipo de Equipo</th>
                                    <th class="col-lg-2">Propietario</th>
                                    <th class="col-lg-1">Acciones</th>
                                    <th class="col-lg-1">Eliminar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($equipos as $equipo)
                                    @if(isNotAdmin($equipo->user->role))
                                        @if($equipo->user->registration_token=="")
                                            <tr class="gradeA" data-id="{{$equipo->id}}">
                                                <td>{{$equipo->id}}</td>
                                                <td>{{$equipo->s_n}}</td>
                                                <td>{{$equipo->model}}</td>
                                                <td>{{$equipo->type->tipoequipo}}</td>
                                                <td>{{$equipo->user->fullname}}</td>
                                                <td>
                                                    <p class="text-center"><a
                                                                href="{{route('admin.equipo.edit', $equipo->id)}}"><img
                                                                    src="{{asset('imag/Edit.png')}}"
                                                                    title="Editar a {{$equipo->s_n}}"></a> ||
                                                        @if($equipo->terminado != 0)
                                                            <a href="#"><img src="{{asset('imag/forudaa.png')}}"
                                                                             title="Terminado"></a>
                                                        @else
                                                            <a
                                                                    href="{{route('terminar',$equipo->id)}}"><img
                                                                        title="Faltan equipos por arreglarce"
                                                                        src="{{asset('imag/noterminado.png')}}"></a>
                                                        @endif
                                                    </p>
                                                </td>
                                                <td >
                                                    <p class="text-center"><a
                                                                href="#" class="btn-delete"><img
                                                                    title="Eliminar a {{$equipo->s_n}}"
                                                                    src="{{asset('imag/delete.png')}}"></a>

                                                    </p>
                                                </td>

                                            </tr>
                                        @endif
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
            $(document).on('click', '.btn-delete', function (e) {
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
                        alert('El EQUIPO no fue eliminado');
                        row.show();
                    });
                }
            });
        });

    </script>



@stop
