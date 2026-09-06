<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Inicio de Sesión</title>
        <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <!-- ================== BEGIN core-css ================== -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <link href="{{URL::asset('/assets/css/vendor.min.css')}}" rel="stylesheet" />
        <link href="{{URL::asset('/assets/css/default/app.min.css')}}" rel="stylesheet" />
        <!-- ================== END core-css ================== -->
    </head>
    <body class='pace-top'>
        <!-- BEGIN #loader -->
        <div id="loader" class="app-loader">
            <span class="spinner"></span>
        </div>
        <!-- END #loader -->


        <!-- BEGIN #app -->
        <div id="app" class="app">
            <!-- BEGIN login -->
            <div class="login login-v2 fw-bold">
                <!-- BEGIN login-cover -->
                <div class="login-cover">
                    <div class="login-cover-img" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)" data-id="login-cover-image"></div>
                    <div class="login-cover-bg"></div>
                </div>
                <!-- END login-cover -->

                <!-- BEGIN login-container -->
                <div class="login-container">
                    <!-- BEGIN login-header -->
                    <div class="login-header">
                        <div class="brand">
                            <div class="d-flex align-items-center">
                                <img src="{{URL::to('intelho/logo_mini.png')}}" style="width: 30px; height: 30px;"><b>IG</b> CRM</a>
<!--                                <span class="logo"></span> <b>Color</b> Admin-->
                            </div>
                            <small>Innovación de Software & Hardware</small>
                        </div>
                        <div class="icon">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>
                    <!-- END login-header -->

                    <!-- BEGIN login-content -->
                    <div class="login-content">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            @if($errors->any())
                            <div class="alert alert-dark alert-dismissible fade show">
                                <strong>Error!</strong>
                                <br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>

                                <button type="button" class="btn-close" data-bs-dismiss="alert"></span>
                            </div>
                            @endif
                            <div class="form-floating mb-20px">
                                <input type="text" name="username" id="username" class="form-control fs-13px h-45px border-0" placeholder="Email Address" id="emailAddress" />
                                <label for="emailAddress" class="d-flex align-items-center text-gray-600 fs-13px">Usuario</label>
                            </div>
                            <div class="form-floating mb-20px">
                                <input type="password" name="password" id="password" value="" class="form-control fs-13px h-45px border-0" placeholder="Contraseña" />
                                <label for="emailAddress" class="d-flex align-items-center text-gray-600 fs-13px">Contraseña</label>
                            </div>
                            <div class="mb-20px">
                                <button type="submit" class="btn btn-success d-block w-100 h-45px btn-lg">Iniciar Sesión</button>
                            </div>
                        </form>
                    </div>
                    <!-- END login-content -->
                </div>
                <!-- END login-container -->
            </div>
            <!-- END login -->

            <!-- BEGIN login-bg -->
            <div class="login-bg-list clearfix">
                <div class="login-bg-list-item active"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/img/login-bg/login-bg-17.jpg" style="background-image: url(../assets/img/login-bg/login-bg-17.jpg)"></a></div>
                <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/img/login-bg/login-bg-16.jpg" style="background-image: url(../assets/img/login-bg/login-bg-16.jpg)"></a></div>
                <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/img/login-bg/login-bg-15.jpg" style="background-image: url(../assets/img/login-bg/login-bg-15.jpg)"></a></div>
                <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/img/login-bg/login-bg-14.jpg" style="background-image: url(../assets/img/login-bg/login-bg-14.jpg)"></a></div>
                <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/img/login-bg/login-bg-13.jpg" style="background-image: url(../assets/img/login-bg/login-bg-13.jpg)"></a></div>
                <div class="login-bg-list-item"><a href="javascript:;" class="login-bg-list-link" data-toggle="login-change-bg" data-img="../assets/img/login-bg/login-bg-12.jpg" style="background-image: url(../assets/img/login-bg/login-bg-12.jpg)"></a></div>
            </div>
            <!-- END login-bg -->

            <!-- BEGIN scroll-top-btn -->
            <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top" data-toggle="scroll-to-top"><i class="fa fa-angle-up"></i></a>
            <!-- END scroll-top-btn -->
        </div>
        <!-- END #app -->

        <!-- ================== BEGIN core-js ================== -->
        <script src="{{URL::asset('/assets/js/vendor.min.js')}}"></script>
        <script src="{{URL::asset('assets/js/app.min.js')}}"></script>
        <script src="{{URL::asset('assets/js/theme/default.min.js')}}"></script>
        <!-- ================== END core-js ================== -->

        <!-- ================== BEGIN page-js ================== -->
        <script src="{{URL::asset('assets/js/demo/login-v2.demo.js')}}"></script>
        <!-- ================== END page-js ================== -->
    </body>
</html>