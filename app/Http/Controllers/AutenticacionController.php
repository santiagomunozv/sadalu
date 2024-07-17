<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\AuthService;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AutenticacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['only' => 'mostrarLoginForm']);
    }

    /**
     * Controlador empleado para recibir y procesar las solicitudes de logueo en la aplicación
     * Requisitos para hacer login:
     *
     *  - El usuario debe tener uno o varios registros en la tabla usuariocompaniarol
     */
    public function login()
    {
        $credenciales = $this->validate(request(), [
            'loginUsuario' => 'required|string',
            'password' => 'required|string'
        ]);
        //si no se tienen datos en la tabla usuariocompaniarol no dejar pasar el login
        if (Auth::attempt($credenciales) && AuthService::setSessionModels()) {
            return redirect("/");
        }
        self::endSessionObjects();
        return back()->withErrors(['authFailed' => trans('auth.failed')]);
    }

    public function cambioCompania(Request $request)
    {
        $companiaId = $request->get("compania");
        //si no se encuentran datos para la compania indicada redireccionar a
        //login
        if ($companiaId && AuthService::setSessionModelsByCompania($companiaId)) {
            return redirect("/");
        }
        self::endSessionObjects();
        return redirect('/login');
    }

    public function logout()
    {
        self::endSessionObjects();
        return redirect('/login');
    }

    public function mostrarLoginForm()
    {
        session(['link' => url()->previous()]);
        return view('auth.login');
    }

    private static function endSessionObjects()
    {
        Session::flush();
        Auth::logout();
    }
}
