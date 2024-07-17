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
    {!! Html::style('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css') !!}

    {{-- {!!Html::style('https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i')!!} --}}
    <!-- Custom styles for this template-->
    {!! Html::style('css/sb-admin-2.min.css') !!}
    {!! Html::style('css/sadalu.css') !!}
    <!-- Estilos para Datatables -->
    {!! Html::style('vendor/datatables/dataTables.bootstrap4.min.css') !!}
    <!-- estilos para el calendario de la aplicacion https://gijgo.com/ -->
    {!! Html::style('vendor/gijgo-combined-1.9.11/css/gijgo.min.css') !!}
    {!! Html::style('vendor/dropzone/dropzone.min.css') !!}
    <!-- Estilo para Chosen-select -->
    {!! Html::style('vendor/jquery-chosen/component-chosen.min.css') !!}
    {{-- https://summernote.org --}}
    {!! Html::style('vendor/summernote/summernote-bs4.css') !!}
    <link type="image/x-icon" rel="icon" href="{!! '/images/LogoFavicon.ico' !!}">
    @yield('estilos')
</head>

<body id="page-top" class="sidebar-toggled">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        @include('layouts.principal.barraLateral')
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                @include('layouts.principal.barraSuperior')
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    {{-- <h1 class="h3 mb-2 text-gray-800">@yield('nombreModulo')</h1> --}}
                    @yield('contenido')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            @include('layouts.principal.pie')
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    @include('layouts.principal.modalCerrarSesion')
    <!-- Bootstrap core JavaScript-->
    {!! Html::script('vendor/jquery/jquery.min.js') !!}
    {!! Html::script('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}
    <!-- Core plugin JavaScript-->
    {!! Html::script('vendor/jquery-easing/jquery.easing.min.js') !!}
    <!-- libreria de calendario de la aplicacion https://gijgo.com/ -->
    {!! Html::script('vendor/gijgo-combined-1.9.11/js/gijgo.min.js') !!}
    {!! Html::script('vendor/gijgo-combined-1.9.11/js/messages/messages.es-es.min.js') !!}
    <!-- Custom scripts for all pages-->
    {!! Html::script('js/sb-admin-2.min.js') !!}
    {!! Html::script('js/modal.js') !!}
    {!! Html::script('js/generadorMultiRegistro.js') !!}
    {!! Html::script('js/lgSmModalValidations.js') !!}
    {!! Html::script('js/general.js') !!}
    {!! Html::script('js/grid.js') !!}
    <!-- JS para Chosen-select -->
    {{-- https://harvesthq.github.io/chosen/ --}}
    {!! Html::script('vendor/jquery-chosen/chosen.jquery.min.js') !!}
    <!-- Page level plugins -->
    {!! Html::script('vendor/chart.js/Chart.min.js') !!}
    <!-- Scripts para Datatables -->
    {!! Html::script('vendor/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('vendor/datatables/dataTables.bootstrap4.min.js') !!}
    {!! Html::script('vendor/datatables/dataTables.buttons.min.js') !!}
    {!! Html::script('vendor/datatables/buttons.flash.min.js') !!}
    {!! Html::script('vendor/jszip/jszip.min.js') !!}
    {!! Html::script('vendor/datatables/buttons.html5.min.js') !!}
    <!-- Dropzone js -->
    {!! Html::script('vendor/dropzone/dropzone.min.js') !!}
    {{-- https://summernote.org --}}
    {!! Html::script('vendor/summernote/summernote-bs4.min.js') !!}
    {{-- https://github.com/lukasoppermann/html5sortable --}}
    {!! Html::script('vendor/sortable/html5sortable.js') !!}
    <!-- Page level custom scripts -->

    {{-- {!!Html::script('eonasdan-bootstrap-datetimepicker/bootstrap/bootstrap.min.js'); !!}
        {!!Html::script('eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js'); !!} --}}
    {{-- {!!Html::script('eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css'); !!} --}}
    {{-- {!!Html::script('eonasdan-bootstrap-datetimepicker/bootstrap/bootstrap.min.js'); !!}
        {!!Html::script('eonasdan-bootstrap-datetimepicker/src/js/locales/bootstrap-datetimepicker.es.js'); !!} --}}


    @yield('scripts')
</body>

</html>
