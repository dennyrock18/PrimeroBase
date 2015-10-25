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
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Usuario
                    </div>
                    <div class="panel-body">
                        <p><a href="{{route('admin.user.index')}}" class="btn btn-primary"><i
                                        class="fa fa-hand-o-left fa-fw"></i>Atras</a></p>

                        <p> @include('partials.message')</p>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    {!! Form::open(['route' => 'admin.user.store', 'method' => 'POST']) !!}
                                    <div class="form-group">
                                        {!! Field::text('fullname',['label' => 'Full name','required','class'=> 'form-control', 'placeholder' => 'Please, write the full name']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::email('email',['label' => 'Email-Address','required','class'=> 'form-control', 'placeholder' => 'Please, write the email']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::text('secundaryAddress',['label' => 'Secundary Address','class'=> 'form-control', 'placeholder' => 'Please, write the secundary address']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::select('state',$states ,['empty' => 'Seleccione...','label' => 'Estado','required','id' => 'state','class' => 'form-control']) !!}
                                        {{--<label>
                                            Estado
                                        </label>
                                        <select id="state" class="form-control" name="state">
                                            <option>Seleccione un Estado</option>
                                            @foreach($states as $state)
                                                <option value="{{$state->id}}">{{$state->state}}</option>
                                            @endforeach
                                        </select>--}}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::text('postCode',['label' => 'Post Code','required','class'=> 'form-control', 'placeholder' => 'Please, write the post code']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::password('password',['class'=> 'form-control','required', 'placeholder' => 'Please, write the password']) !!}
                                    </div>
                                    <div class="form-group">

                                    </div>
                                    <div class="form-group">
                                        <p>{!! Form::submit('Crear', ['class' => 'btn btn-success ']) !!}</p>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        {!! Field::text('id_user',['label' => 'Number Id','required','class'=> 'form-control', 'placeholder' => 'Please, write the number id']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::text('streetAddress',['label' => 'Street Address','required','class'=> 'form-control', 'placeholder' => 'Please, write the street address']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Field::text('phone',['label' => 'Phone','required','class'=> 'form-control', 'placeholder' => 'Please, write the phone']) !!}
                                    </div>

                                    <div class="form-group">
                                        {{--{!! Field::select('city_id',null ,['empty' => 'Debe seleccionar primero el estado','required','label' => 'Ciudad','id' => 'city','class' => 'form-control']) !!} --}}
                                        <label >
                                            Ciudad
                                        </label>
                                        <select id="city" class="form-control" name="city_id">
                                            <option>Debe escoger un estado primero</option>
                                        </select>

                                    </div>
                                    <div class="form-group">
                                        {!! Field::select('role', trans('role.types'),['empty' => 'Seleccione...','class' => 'form-control','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::password('password_confirmation',['label' => 'Password Confirmation','class'=> 'form-control', 'placeholder' => 'Please, write the password confirmatio']) !!}
                                    </div>

                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            {!! Form::close() !!}
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
    </div>
    <!-- /#page-wrapper -->

@stop

@section('scripts')
    @include('partials.scriptCountryPais')
@stop

