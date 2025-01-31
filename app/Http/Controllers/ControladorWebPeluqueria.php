<?php

namespace App\Http\Controllers;


class ControladorWebPeluqueria extends Controller
{
    public function index()
    {
      return view("web.peluqueria");
    }
}
