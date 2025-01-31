<?php

namespace App\Http\Controllers;


class ControladorWebBlog extends Controller
{
    public function index()
    {
      return view("web.blog");
    }
}
