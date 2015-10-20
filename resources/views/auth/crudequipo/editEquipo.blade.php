@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Editar</h1>
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
                        <p><a href="{{route('admin.equipo.index')}}" class="btn btn-primary"><i
                                        class="fa fa-hand-o-left fa-fw"></i>Atras</a></p>
                        <p> @include('partials.message')</p>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    {!! Form::model($tipoequipo,['route' => ['admin.equipo.update', $tipoequipo], 'method' => 'PUT']) !!}
                                    <div class="form-group">
                                        {!! Field::text('tipoequipo',['label' => 'Tipo Equipo','required','class'=> 'form-control', 'placeholder' => 'Please, write the tipo de equipo']) !!}
                                    </div>
                                    <div class="form-group">
                                        <p>{!! Form::submit('Crear', ['class' => 'btn btn-success ']) !!}</p>
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


