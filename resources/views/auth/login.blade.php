<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>{{ config('app.name') }} - Login</title>
    <!-- Custom fonts for this template-->
    {!! Html::style('vendor/fontawesome-free/css/all.min.css') !!}
    {!! Html::style(
        'https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i',
    ) !!}
    <!-- Custom styles for this template-->
    {!! Html::style('css/sb-admin-2.min.css') !!}
</head>

<body class="bg-gradient-info">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Iniciar sesión</h1>
                                    </div>
                                    <form method="POST" action="{{ route('login') }}" class="user">
                                        @csrf
                                        <div class="form-group">
                                            <input autocomplete="off"
                                                class="form-control form-control-user {{ $errors->has('loginUsuario') ? 'is-invalid' : '' }}"
                                                type="text" name="loginUsuario" value="{{ old('loginUsuario') }}"
                                                placeholder="Ingrese su usuario" id="exampleInputEmail">
                                        </div>
                                        <div class="form-group">
                                            <input id="exampleInputPassword"
                                                class="form-control form-control-user {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                type="password" name="password" placeholder="Ingrese su contraseña">
                                        </div>
                                        <button class="btn btn-info btn-user btn-block">Acceder</button>
                                    </form>
                                    <hr>
                                    @if (session()->has('flash'))
                                        <div class="alert alert-danger">{{ session('flash') }}</div>
                                    @endif
                                    {!! $errors->first('authFailed', '<div class="alert alert-danger"> :message </div>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    {!! Html::script('vendor/jquery/jquery.min.js') !!}
    {!! Html::script('vendor/bootstrap/js/bootstrap.bundle.min.js') !!}
    <!-- Core plugin JavaScript-->
    {!! Html::script('vendor/jquery-easing/jquery.easing.min.js') !!}
    <!-- Custom scripts for all pages-->
    {!! Html::script('js/sb-admin-2.min.js') !!}
</body>

</html>
