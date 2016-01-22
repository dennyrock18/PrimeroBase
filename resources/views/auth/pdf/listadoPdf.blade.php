@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Listado de Informes</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Pdfs
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        @include('partials.message')
                        <div class="dataTable_wrapper">

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>Id_BD</th>
                                    <th>Nombre</th>
                                    <th>Generado</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pdfs  as $pdf)
                                    <tr class="gradeA" data-id="{{$pdf->id}}">
                                        <td>{{$pdf->id}}</td>
                                        <td>{{$pdf->name}}</td>
                                        <td>{{$pdf->user->fullname}}</td>
                                        <td>{{fecha($pdf->created_at)}}</td>
                                        <td>{{hora($pdf->created_at)}}</td>
                                        <td>
                                            <center>
                                            <a href="{{route('downloadPdf', $pdf) }}"><img
                                                    src="{{asset('imag/cloud-arrow-down-32.png')}}"
                                                    title="Descargar"></a> || <a href="{{url('/storage/' . $pdf->name)}}" target="_blank"><img
                                                            src="{{asset('imag/Edit.png')}}"
                                                            title="Ver"></a> <!--|| <a
                                                href="#" class="btn-delete"></a>--></center>
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
