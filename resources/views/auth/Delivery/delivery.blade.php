@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Deliverys</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">


                <p> @include('partials.message')</p>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-clock-o fa-fw"></i> Usuarios
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <ul class="timeline">
                            <?php $contar = 0?>
                            @foreach($users as $user)
                                <li class="{{$contar%2 != 0 ? 'timeline-inverted':''}}">
                                    <div class="timeline-badge ">
                                        <a href="{{route('mapa', $user->id)}}"><img data-toggle="tooltip"
                                                                                    data-placement="top" title="Maps"
                                                                                    src="{{asset('imag/maps.png')}}"
                                                                                    title="Detalle de {{$user->fullname}}"></a>
                                    </div>
                                    <div class="timeline-panel">
                                        <div class="timeline-heading">
                                            <h4 class="timeline-title"><h3>{{$user->fullname}}</h3></h4>
                                        </div>
                                        <div class="timeline-body">

                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    <p>
                                                        Direccion: {{$user->direccion}}</p>
                                                </div>
                                                <div class="panel-body">
                                                    <p>Fecha de Entrega: {{cambiarFecha($user->fecha_entrega)}}</p>

                                                    <p>Cantidad de equipos a entregar: {{$user->total_equipo}}</p>
                                                </div>
                                            </div>


                                            <hr>
                                            @if (auth()->user()->role =='admin')
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary btn-sm dropdown-toggle"
                                                            data-toggle="dropdown">
                                                        <i class="fa fa-gear"></i> <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="#" data-toggle="modal"
                                                               data-target="#myModal{{$user->id}}"> <i
                                                                        class="fa fa-calendar"></i> Cambiar Fecha</a>

                                                        </li>
                                                        <li class="divider"></li>
                                                        <li data-id="{{$user->id}}"><a href="#" id="cDelivery">  <i
                                                                        class="fa fa-times"></i> Cancelar
                                                                Delivery</a>
                                                        </li>

                                                    </ul>
                                                    {!! Form::open(['route' => ['fechaEntregaDelivery',$user], 'method' => 'PUT']) !!}
                                                    @include('auth.Admin.partials.modalUser')
                                                    {!! Form::close()!!}
                                                </div>
                                            @endif
                                        </div>

                                    </div>
                                </li>
                                <?php $contar++?>
                            @endforeach
                        </ul>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dataTables_info" id="dataTables-example_info" role="status"
                                     aria-live="polite">
                                    @if($users->total()!=0)
                                        Showing {{ $users->currentPage()}} to {{$users->total()}}
                                        of {{$users->count()}} entries
                                    @else
                                        <h3>No hay delivery que realizar</h3>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="dataTables_paginate paging_simple_numbers"
                                     id="dataTables-dataTables-example_paginate">{!! $users->render() !!}</div>
                            </div>
                        </div>

                    </div>
                    <!-- /.panel-body -->
                </div>

            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- /#page-wrapper -->

    @stop

    @section('scripts')

            <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
        $(document).ready(function () {
            @include('partials.datepicker')

            $(document).on('click', '#cDelivery', function (e) {
                e.preventDefault()

                var row = $(this).parents('li');
                var user_id = row.data('id');

                $.get('{{url('/cancelar/delivery')}}',{id_user: user_id}, function (respuesta) {

                    row.fadeOut();
                    //$('#timeline').update();
                });
            });

        });
    </script>

@stop

