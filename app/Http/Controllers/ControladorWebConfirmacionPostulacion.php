<?php

namespace App\Http\Controllers;

use App\Entidades\CarritoProducto;
use Session;
class ControladorWebConfirmacionPostulacion extends Controller
{
    public function index()
    {

        $idCliente = Session::get("fk_idcliente");
        $cantidadCarrito = "";
        if ($idCliente) {
            $carritoProducto = new CarritoProducto();
            $cantidadCarrito = $carritoProducto->obtenerCantidadPorCliente($idCliente);
        }

        return view("web.confirmacion-postulacion", compact('cantidadCarrito'));
    }
}