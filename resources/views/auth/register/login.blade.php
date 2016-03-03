@extends('layouts/masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <div class="form-signin-heading text-center">
                            <img src="{{asset('imag/admin.png')}}" height="130px" alt=""/>
                        </div>
                    </div>

                    <div class="panel-body ">
                        @include('errors.form_error')
                        @include('partials.message')
                        <div class="login-box-body">
                            <p class="login-box-msg text-center">Sign in to start your session</p>

                            <form action="{{route('login') }}" method="post">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="form-group has-feedback">
                                    <input type="email" class="form-control" placeholder="Email" name="email"/>
                                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                                </div>
                                <div class="form-group has-feedback">
                                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                                </div>
                                <div class="row ">
                                    <div class="col-xs-8 ">
                                        <div class="checkbox icheck">
                                            <label>
                                                <input type="checkbox" name="remember"> Remember Me
                                            </label>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-xs-4">
                                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In
                                        </button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                            <a href="{{ url('/password/email') }}">I forgot my password</a><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('s')
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
@endsection

@endsection