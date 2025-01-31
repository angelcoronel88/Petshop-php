<?php

namespace App\Http\Controllers;
use App\Entidades\Cliente;
use Illuminate\Http\Request;

class ControladorWebRegistrarse extends Controller
{
    public function index()
    {
        return view("web.registrarse");
    }


    public function registrarse(Request $request){

        $cliente = New Cliente(); 
        $cliente->nombre = $request->input("txtNombre");
        $cliente->apellido = $request->input("txtApellido");
        $cliente->correo = $request->input("txtCorreo");
        $cliente->celular = $request->input("txtCelular");
        $cliente->dni = $request->input("txtDni");
        $cliente->clave = password_hash(($request->input("txtClave")), PASSWORD_DEFAULT);
        $cliente->insertar();
        return redirect("/iniciar-sesion")->with('success', 'Te has registrado exitosamente!');
    } 
}