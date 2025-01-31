<?php

namespace App\Http\Controllers;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use Illuminate\Http\Request;
use Session;

class ControladorWebIniciarSesion extends Controller
{
    public function index()
    {
            return view("web.iniciar-sesion");
    }


    public function ingresar(Request $request) {
        $correo = $request->input("txtCorreo");
        $clave = $request->input("txtClave");
        $cliente = new Cliente();
        $cliente->obtenerPorCorreo($correo);
        if($cliente && password_verify($clave, $cliente->clave)){
            Session::put("fk_idcliente", $cliente->idcliente);
            return redirect('/productos');
        } else {
            $mensaje = "Credenciales incorrectas";
            $sucursal = new Sucursal();
            $aSucursales = $sucursal->obtenerTodos();
            return view("web.iniciar-sesion", compact("aSucursales", "mensaje"));
        }
    }

    
    public function cerrarSesion(){
        Session::put("fk_idcliente", "");
        return redirect("/");
    }
}