@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Agregar</h3>
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
                        <p><a href="{{route('admin.tipoequipo.index')}}" class="btn btn-primary"><i
                                        class="fa fa-hand-o-left fa-fw"></i>Atras</a></p>
                        <p> @include('partials.message')</p>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    {!! Form::open(['route' => 'admin.tipoequipo.store', 'method' => 'POST']) !!}
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


