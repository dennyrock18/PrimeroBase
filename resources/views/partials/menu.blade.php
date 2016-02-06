<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{route('welcomeAdmin')}}">admin</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-envelope fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-messages">
                @if(count(NoAceptadoCorreo())!=0)
                    @foreach(NoAceptadoCorreo() as $userNoAcep)
                        <li>
                            <a href="#">
                                <div>
                                    <strong>{{$userNoAcep->fullname}}</strong>
                                    <span class="pull-right text-muted">
                                        <em>{{diasEntreFechas($userNoAcep->created_at)}}</em>
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                    @endforeach
                @else
                    <li>
                        <a href="#">
                            <div>
                                <strong>Cuentas Activadas</strong>
                                    <span class="pull-right text-muted">
                                        <em>Todas</em>
                                    </span>
                            </div>
                        </a>
                    </li>
                    <li class="divider"></li>
                @endif
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-tasks fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-tasks">
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 1</strong>
                                <span class="pull-right text-muted">40% Complete</span>
                            </p>

                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                    <span class="sr-only">40% Complete (success)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 2</strong>
                                <span class="pull-right text-muted">20% Complete</span>
                            </p>

                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                    <span class="sr-only">20% Complete</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 3</strong>
                                <span class="pull-right text-muted">60% Complete</span>
                            </p>

                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                    <span class="sr-only">60% Complete (warning)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <p>
                                <strong>Task 4</strong>
                                <span class="pull-right text-muted">80% Complete</span>
                            </p>

                            <div class="progress progress-striped active">
                                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80"
                                     aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                    <span class="sr-only">80% Complete (danger)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Tasks</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-tasks -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-user fa-fw"></i> New User Registrated
                            <span class="pull-right text-muted small">4 minutes ago</span>
                            asdasdasd
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                            <span class="pull-right text-muted small">12 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-tasks fa-fw"></i> New Task
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="#">
                        <div>
                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                            <span class="pull-right text-muted small">4 minutes ago</span>
                        </div>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a class="text-center" href="#">
                        <strong>See All Alerts</strong>
                        <i class="fa fa-angle-right"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> {{currentUser()->fullname}} <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="{{route('detailsUserAdmin', currentUser()->id)}}"><i class="fa fa-user fa-fw"></i> User
                        Profile</a>
                </li>
                <li><a href="{{route('changePassword')}}"><i class="fa fa-key fa-fw"></i> Change Password</a>
                </li>
                <li class="divider"></li>
                <li><a href="{{route('logaut')}}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">

            <ul class="nav" id="side-menu">

                <li>
                    <a href="{{route('welcomeAdmin')}}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                @if(currentUser()->role == 'admin')
                    <li>
                        @if(currentUser()->role!='chofer')
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Sistema<span class="fa arrow"></span></a>
                        @endif

                        <ul class="nav nav-second-level">
                            @if(currentUser()->email== 'admin@demo.com')
                                <li>
                                    <a href="{{route('admin.admin.index')}}"><i class="fa fa-key fa-fw"></i> Adminis
                                        del Sistema</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('admin.tipoequipo.index')}}"><i class="fa fa-list-ul fa-fw"></i> Tipos
                                    de
                                    Equi1pos</a>
                            </li>
                            <li>
                                <a href="{{route('admin.chofer.index')}}"><i class="fa fa-automobile fa-fw"></i> Chofer</a>
                            </li>
                            <li>
                                <a href="{{route('admin.list.reporte.pdf.index')}}"><i
                                            class="fa fa-file-pdf-o fa-fw"></i>
                                    Report Sistem</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-list-ol fa-fw"></i> Funcionalidades <span
                                    class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="{{route('admin.user.index')}}"><i class="fa fa-users fa-fw"></i> Usuarios</a>
                            </li>
                            <li>
                                <a href="{{route('admin.add.user.equipos.index')}}"><i class="fa fa-laptop fa-fw"></i>
                                    Asignar Equipos</a>
                            </li>

                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="{{route('admin.equipo.index')}}"><i class="fa fa-table fa-fw"></i> Equipos en el
                            Sistema</a>
                    </li>
                @endif
                <li>
                    <a href="#"><i class="fa fa-truck fa-fw"></i> Delivery</a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="{{route('delivery.index')}}"><i class="fa fa-users fa-fw"></i> Deliveris a Realizar</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-laptop fa-fw"></i>
                                Deliveris Realizados</a>
                        </li>

                    </ul>
                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>