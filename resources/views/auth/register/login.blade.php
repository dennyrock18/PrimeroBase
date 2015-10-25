@extends('layouts/masterlayout')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                       <center> <h3 class="sign-title">Iniciar Sesi&oacute;n</h3></center>
                    </div>
                    <div class="panel-body ">
                        <form class="form-horizontal" role="form" method="POST" action="{{route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <fieldset>
                                <div class="form-signin-heading text-center">
                                    <img src="{{asset('imag/admin.png')}}" height="130px" alt=""/>
                                </div>

                                <div class="login-wrap">
                                    <div>
                                        <label class="form-group-lg">
                                            Email
                                        </label>
                                        <input class="form-control" placeholder="E-mail" name="email" type="email"
                                               autofocus>
                                    </div>
                                    <div>
                                        <label class="form-group-lg">
                                            Password
                                        </label>
                                        <input class="form-control" placeholder="Password" name="password"
                                               type="password" value="">
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input name="remember" type="checkbox">Remember Me
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-lg btn-success btn-block"><i class="fa fa-check"></i>
                                    </button>
                                    <center>
                                        <a class="btn btn-link " href="{{ route('urlpass') }}">¿Olvidaste tu
                                            contraseña?</a></center>
                                </div>
                            </fieldset>
                        </form>
                        @include('errors.form_error')
                        @include('partials.message')
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
