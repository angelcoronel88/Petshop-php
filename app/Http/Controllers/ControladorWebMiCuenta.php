<?php

namespace App\Http\Controllers;


use App\Entidades\CarritoProducto;
use App\Entidades\Cliente;
use App\Entidades\Pedido;
use Illuminate\Http\Request;
use Session;


class ControladorWebMiCuenta extends Controller
{
    public function index()
    {
        $idCliente = Session::get("fk_idcliente");

        if (($idCliente) > 0) {
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);

            $cantidadCarrito = "";
            if ($idCliente) {
                $carritoProducto = new CarritoProducto();
                $cantidadCarrito = $carritoProducto->obtenerCantidadPorCliente($idCliente);
            }

            //Obtener todos los pedidos del cliente
            $pedido = new Pedido();
            $aPedidos = $pedido->obtenerPorCliente($idCliente);

            return view("web.mi-cuenta", compact('cliente', 'cantidadCarrito', 'aPedidos'));
        } else {
            return redirect("/iniciar-sesion");
        }
    }


    public function guardar(Request $request)
    {
        $nombre = $request->input("txtNombre");
        $apellido = $request->input("txtApellido");
        $celular = $request->input("txtCelular");
        $correo = $request->input("txtCorreo");
        $dni = $request->input("txtDni");
        $cliente = new Cliente();
        $cliente->idcliente = Session::get("fk_idcliente");
        $cliente->nombre = $nombre;
        $cliente->apellido = $apellido;
        $cliente->celular = $celular;
        $cliente->correo = $correo;
        $cliente->dni = $dni;
        $cliente->editar();
        return redirect("/mi-cuenta");
    }
}