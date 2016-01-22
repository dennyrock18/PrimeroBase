@extends('layouts/master')

@section('content')

    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Editar User</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$user->fullname}}
                    </div>
                    <div class="panel-body">
                        <p><a href="{{route('detailsUser', $user->id)}}" class="btn btn-primary"><i
                                        class="fa fa-hand-o-left fa-fw"></i>Atras</a></p>

                        <p> @include('partials.message')</p>

                        <div class="row">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    {!! Form::model($user,['route' => ['admin.user.update', $user], 'method' => 'PUT']) !!}
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
                                        {!! Field::select('state',state(),$user->stateid, ['empty'=>'Seleccione...','label' => 'Estado','id' => 'state','class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::text('postCode',['label' => 'Post Code','pattern'=>'^\d{5}$','maxlength'=>'5','required','class'=> 'form-control', 'placeholder' => 'Please, write the post code']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::password('password',['class'=> 'form-control']) !!}
                                    </div>

                                    <div class="form-group">
                                        <p>{!! Form::submit('Aceptar', ['class' => 'btn btn-success ']) !!}</p>
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
                                        {!! Field::tel('phone',['label' => 'Phone Number [format: (xxx)-xxx-xxxx]:','pattern'=>'^\(\d{3}\)-\d{3}-\d{4}$','maxlength'=>'14','required','class'=> 'form-control', 'placeholder' => 'Please, write the phone']) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Field::select('city_id',city($user->stateid) ,['empty' => 'Debe escojer un estado primero','label' => 'City','required','class' => 'form-control']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::text('role', 'User',['label'=> 'Role','class' => 'form-control','disabled'=>'enable']) !!}
                                        {!! Field::hidden('role', 'user',['label'=> 'Role','class' => 'form-control']) !!}
                                        {{--{!! Field::select('role', trans('role.types'),['empty' => 'User','id'=>'disabledSelect','class' => 'form-control','required','disabled'=>'enable']) !!}--}}
                                    </div>
                                    <div class="form-group">
                                        {!! Field::password('password_confirmation',['label' => 'Password Confirmation','class'=> 'form-control']) !!}
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

