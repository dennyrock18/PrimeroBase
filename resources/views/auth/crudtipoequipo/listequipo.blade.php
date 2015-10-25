@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Listado de Tipo de Equipos</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Equipos
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @include('partials.message')
                        <div class="dataTable_wrapper">
                            <p><a title="Agregar Equipo" href="{{route('admin.tipoequipo.create')}}"
                                  class="btn btn-primary"><i
                                            class="fa fa-plus-circle fa-fw"></i>Agregar Equipo</a></p>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Id_BD</th>
                                    <th>Equipo</th>
                                    <th class="col-lg-2">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tipoequipo as $tpe)
                                    <tr class="gradeA" data-id="{{$tpe->id}}">
                                        <td>{{$tpe->id}}</td>
                                        <td>{{$tpe->tipoequipo}}</td>
                                        <td><a href="{{route('admin.tipoequipo.edit', $tpe->id)}}"><img
                                                        src="{{asset('imag/Edit.png')}}"
                                                        title="Editar a {{$tpe->tipoequipo}}"></a> || <a
                                                    href="#" class="btn-delete"><img
                                                        title="Eliminar {{$tpe->tipoequipo}}"
                                                        src="{{asset('imag/delete.png')}}"></a>

                                        </td>


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
    {!! Form::open(['route' => ['admin.tipoequipo.destroy', ':EQUIPO_ID'], 'method' => 'DELETE', 'id' => 'form-delete']) !!}
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
            $('.btn-delete').click(function (e) {
                e.preventDefault()

                var row = $(this).parents('tr');
                var id = row.data('id');
                var form = $('#form-delete');
                var url = form.attr('action').replace(':EQUIPO_ID', id);
                var data = form.serialize();


                $.post(url, data, function (result) {
                    alert(result.message);
                    row.fadeOut();
                }).fail(function () {
                    alert('El equipo no fue eliminado, Tiene elementos asociados a el');
                    row.show();
                });
            });
        });

    </script>



@stop
