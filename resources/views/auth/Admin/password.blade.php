@extends('layouts/master')

@section('content')
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{auth()->user()->fullname}}
                    <small></small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p>
                            <i class="fa fa-key"></i> Change Password</p>
                    </div>
                            <!-- /.panel-heading -->
                    <div class="panel-body">
                        @include('errors.form_error')
                        @include('partials.message')
                        <div class="row">

                            <form class="form-horizontal" method="POST" action="{{ route('changePassword') }}">

                                {!! csrf_field() !!}

                                <div class="form-group">
                                    <label class="col-md-4 control-label">@lang('passwords.reset.current_password')</label>

                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="current_password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@lang('passwords.reset.new_password')</label>

                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password">
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label">@lang('passwords.reset.password_confirmation')</label>

                                    <div class="col-md-6">
                                        <input type="password" class="form-control" name="password_confirmation">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                            @lang('passwords.reset.change_button')
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection