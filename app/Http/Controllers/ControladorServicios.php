<?php

namespace App\Http\Controllers;


class ControladorWebServicios extends Controller
{
    public function index()
    {
            return view("web.servicios");
    }
}