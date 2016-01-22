@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Agregar Administrador</h3>
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
                        <p><a href="{{route('admin.admin.index')}}" class="btn btn-primary"><i
                                        class="fa fa-hand-o-left fa-fw"></i>Atras</a></p>

                        <p> @include('partials.message')</p>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    {!! Form::open(['route' => 'admin.admin.store', 'method' => 'POST']) !!}
                                    <div class="form-group">
                                        {!! Field::text('fullname',['label' => 'Full name','required','class'=> 'form-control', 'placeholder' => 'Please, write the full name']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::email('email',['label' => 'Email-Address','required','class'=> 'form-control', 'placeholder' => 'Please, write the email']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::select('state',$states ,['empty' => 'Seleccione...','label' => 'Estado','required','id' => 'state','class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::text('postCode',['label' => 'Post Code','pattern'=>'^\d{5}$','maxlength'=>'5','required','class'=> 'form-control', 'placeholder' => 'Please, write the post code']) !!}
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
                                        {{--{!! Field::hidden('role', 'admin',['label'=> 'Role','class' => 'form-control']) !!}--}}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::text('streetAddress',['label' => 'Street Address','required','class'=> 'form-control', 'placeholder' => 'Please, write the street address']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::select('city_id',null ,['empty' => 'Debe escojer un estado primero','label' => 'City','required','class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::tel('phone',['label' => 'Phone Number [format: (xxx)-xxx-xxxx]:','required','class'=> 'form-control','pattern'=>'^\(\d{3}\)-\d{3}-\d{4}$','maxlength'=>'14' ,'placeholder' => 'Please, write the phone']) !!}
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

