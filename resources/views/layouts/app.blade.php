<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SIGCRM | @yield('title')</title>
    <link rel="icon" href="{{URL::to('intelho/logo_mini.png')}}" type="image/png" />
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="sistema crm" />
    <meta content="" name="johntellojohn" />
    <!-- ================== BEGIN core-css ================== -->
    @include('layouts.css_styles')
    @yield('custom_css')
    <!-- ================== END core-css ================== -->
</head>

<body>
    <!-- BEGIN #loader -->
    <div id="loader" class="app-loader">
        <span class="spinner"></span>
    </div>
    <!-- END #loader -->
    <!-- BEGIN #app -->
    <div id="app" class="app app-header-fixed app-sidebar-fixed">
        <!-- BEGIN #header -->
        <div id="header" class="app-header">
            <!-- BEGIN navbar-header -->
            <div class="navbar-header">
                <a href="{{URL::to('/')}}" class="navbar-brand"><img src="{{URL::to('intelho/logo_mini.png')}}" style="width: 20px; height: 20px;"><b>IG</b> CRM</a>
                <button type="button" class="navbar-mobile-toggler" data-toggle="app-sidebar-mobile">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- END navbar-header -->

            <!-- BEGIN header-nav -->
            <div class="navbar-nav">
                <div class="navbar-item navbar-form">
                    <form action="" method="POST" name="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Ingrese una palabra" />
                            <button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>

                <div class="navbar-item dropdown">
                    <a href="#" data-bs-toggle="dropdown" class="navbar-link dropdown-toggle fs-14px">
                        <i class="fa fa-bell"></i>
                        <span class="badge">0</span>
                    </a>
                    <div class="dropdown-menu media-list dropdown-menu-end">
                        <div class="dropdown-header">NOTIFICATIONS (0)</div>
                        <div class="text-center w-300px py-3">
                            No notification found
                        </div>
                    </div>
                </div>
                <div class="navbar-item navbar-user dropdown">
                    <a href="#" class="navbar-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                        <div class="image image-icon bg-gray-800 text-gray-600">
                            <i class="fa fa-user"></i>
                        </div>
                        <span class="d-none d-md-inline">{{ (Auth::user()->firstname.' '.Auth::user()->lastname) ?? 'Invitado' }}</span> <b class="caret ms-10px"></b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end me-1">
                        <a href="{{URL::to('/usuarios/profile')}}" class="dropdown-item">Editar Perfil</a>
                        <a href="javascript:;" class="dropdown-item">Configuración</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <!-- END header-nav -->
        </div>
        <!-- END #header -->
        <!-- BEGIN #sidebar -->
        <div id="sidebar" class="app-sidebar">
            <!-- BEGIN scrollbar -->
            <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
                <!-- BEGIN menu -->
                <div class="menu">
                    <div class="menu-profile">
                        <a href="javascript:;" class="menu-profile-link" data-toggle="app-sidebar-profile" data-target="#appSidebarProfileMenu">
                            <div class="menu-profile-cover with-shadow"></div>
                            <div class="menu-profile-image menu-profile-image-icon bg-gray-900 text-gray-600">
                                @if(Auth::user()->photo !== null)
                                <img src="{{ URL::asset('/uploads/users/' . Auth::user()->photo) }}" class="img-circle elevation-2" alt="User Image">
                                @else
                                <i class="fa fa-user"></i>
                                @endif
                            </div>
                            <div class="menu-profile-info">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1">
                                        @guest
                                        {{ __('Iniciar Sesión') }}
                                        @else
                                        {{ (Auth::user()->firstname.' '.Auth::user()->lastname) ?? 'Invitado' }}
                                        @endguest
                                    </div>
                                    <div class="menu-caret ms-auto"></div>
                                </div>
                                <small>{{'@'. Auth::user()->username }}</small>
                            </div>
                        </a>
                    </div>
                    <div id="appSidebarProfileMenu" class="collapse">
                        <div class="menu-item pt-5px">
                            <a href="javascript:;" class="menu-link">
                                <div class="menu-icon"><i class="fa fa-cog"></i></div>
                                <div class="menu-text">Settings</div>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="javascript:;" class="menu-link">º
                                <div class="menu-icon"><i class="fa fa-pencil-alt"></i></div>
                                <div class="menu-text"> Send Feedback</div>
                            </a>
                        </div>
                        <div class="menu-item pb-5px">
                            <a href="javascript:;" class="menu-link">
                                <div class="menu-icon"><i class="fa fa-question-circle"></i></div>
                                <div class="menu-text"> Helps</div>
                            </a>
                        </div>
                        <div class="menu-divider m-0"></div>
                    </div>

                    <div class="menu-header">Navegación</div>
                    <div class="menu-item active">
                        <a href="{{URL::to('/')}}" class="menu-link">
                            <div class="menu-icon">
                                <i class="fa fa-th-large"></i>
                            </div>
                            <div class="menu-text">Home</div>
                        </a>
                    </div>
                    <div class="menu">
                        @foreach ($menusComposer as $key => $item)
                        @if ($item["menu_id"] != 0)
                        @break
                        @endif
                        @include("layouts.menu-item", ["item" => $item])
                        @endforeach
                    </div>
                    <!-- BEGIN minify-button -->
                    <div class="menu-item d-flex">
                        <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i class="fa fa-angle-double-left"></i></a>
                    </div>
                    <!-- END minify-button -->

                </div>
                <!-- END menu -->
            </div>
            <!-- END scrollbar -->
        </div>
        <div class="app-sidebar-bg"></div>
        <div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a></div>
        <!-- END #sidebar -->

        <!-- BEGIN #content -->
        <div id="content" class="app-content">
            <!-- BEGIN breadcrumb -->
            <ol class="breadcrumb float-xl-end">
                <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Inicio</a></li>
                <li class="breadcrumb-item active">@yield('breadcrumbs2')</li>
            </ol>
            <!-- END breadcrumb -->
            <!-- BEGIN page-header -->
            <h1 class="page-header">@yield('breadcrumbs1')</h1>
            <!-- END page-header -->

            <!-- BEGIN panel -->
            <div class="app">
                @yield('content')
            </div>
            <!-- END panel -->
        </div>
        <!-- END #content -->

        <!-- BEGIN scroll to top btn -->
        <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
        <!-- END scroll to top btn -->
    </div>
    <!-- END #app -->

    <!-- ================== BEGIN core-js ================== -->
    @include('layouts.js_library')
    @yield('scripts')
    <!-- ================== END core-js ================== -->
</body>

</html>