<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Sigcrm | 404 Error</title>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <!-- ================== BEGIN core-css ================== -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="../assets/css/vendor.min.css" rel="stylesheet" />
    <link href="../assets/css/default/app.min.css" rel="stylesheet" />
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
        <!-- BEGIN error -->
        <div class="error">
            <div class="error-code">404</div>
            <div class="error-content">
                <div class="error-message">No hemos podido encontrar esta página...</div>
                <div class="error-desc mb-4">
                    La página que estás buscando no existe. <br />
                    Quizás, estas páginas le ayudarán a encontrar lo que está buscando.
                </div>
                <div>
                    <a href="{{URL::to('/')}}" class="btn btn-success px-3">Inicio</a>
                </div>
            </div>
        </div>
        <!-- END error -->

    </div>
    <!-- END #app -->

    <!-- ================== BEGIN core-js ================== -->
    <script src="../assets/js/vendor.min.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/js/theme/default.min.js"></script>
    <!-- ================== END core-js ================== -->
</body>

</html>