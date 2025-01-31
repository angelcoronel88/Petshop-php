<?php

namespace App\Http\Controllers;

class ControladorWebConfirmacionCompra extends Controller
{
    public function index()
    {
        return view("web.confirmacion-compra");
    }
}