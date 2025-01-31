<?php

namespace App\Http\Controllers;
use App\Entidades\CarritoProducto;
use App\Entidades\Postulacion;
use Illuminate\Http\Request;
use Session;

class ControladorWebNosotros extends Controller
{
    public function index()
    {
        $idCliente = Session::get("fk_idcliente");
        $cantidadCarrito = "";
        if($idCliente){
            $carritoProducto = new CarritoProducto();
            $cantidadCarrito = $carritoProducto->obtenerCantidadPorCliente($idCliente);
        }
        return view("web.nosotros", compact("cantidadCarrito"));
    }


    public function guardarPostulacion(Request $request){
        $postulacion = new Postulacion();
        $postulacion->nombre = $request->input("txtNombre");
        $postulacion->apellido = $request->input("txtApellido");
        $postulacion->celular = $request->input("txtCorreo");
        $postulacion->correo = $request->input("txtCelular");
     
        if ($_FILES["archivoCurriculum"]["error"] === UPLOAD_ERR_OK) { //Se adjunta imagen
            $extension = pathinfo($_FILES["archivoCurriculum"]["name"], PATHINFO_EXTENSION);
             $nombreArchivo = date("Ymdhmsi") . ".$extension";
             $archivo = $_FILES["archivoCurriculum"]["tmp_name"];
             move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombreArchivo"); //guardaelarchivo
             $postulacion->curriculo = $nombreArchivo;
         }
        $postulacion->insertar();
        return redirect("/confirmacion-postulacion");
    }
}