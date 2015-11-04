@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Agregar equipo a: {{$equipo->user->fullname}}</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Equipo
                    </div>
                    <div class="panel-body">
                        <p><a href="{{route('admin.add.user.equipos.edit', $equipo->user->id)}}" class="btn btn-primary"><i
                                        class="fa fa-hand-o-left fa-fw"></i>Atras</a></p>
                        <p> @include('partials.message')</p>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    {!! Form::model($equipo,['route' => ['admin.equipo.update',$equipo->id], 'method' => 'PUT']) !!}
                                    @include('auth.userEquipo.partials.formequipo')
                                    <div class="form-group">
                                        <p>{!! Form::submit('Actualizar', ['class' => 'btn btn-success ']) !!}</p>
                                    </div>
                                    {!! Form::close() !!}

                                </div>
                            </div>
                        </div>


                                <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

@stop


