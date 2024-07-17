<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('nombreModulo')</title>
    <!-- Custom fonts for this template-->
    {!! Html::style('vendor/fontawesome-free/css/all.min.css') !!}
    <!-- Custom styles for this template-->
    {!! Html::style('css/sb-admin-2.min.css') !!}
    @yield('estilos')
</head>

<body id="page-top" class="sidebar-toggled">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">@yield('nombreModulo')</h1>
                    @yield('contenido')
                </div>
                <!-- /.container-fluid -->
            </div>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Bootstrap core JavaScript-->
    {!! Html::script('vendor/jquery/jquery.min.js') !!}
    {!! Html::script('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}
    <!-- Core plugin JavaScript-->
    {!! Html::script('js/modal.js') !!}
    {!! Html::script('js/reportes.js') !!}

    @yield('scripts')
</body>

</html>
