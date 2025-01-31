<?php

namespace App\Http\Controllers;

use App\Entidades\Categoria;
use App\Entidades\Producto;
use App\Entidades\Pedido;
use Illuminate\Http\Request;

include_once app_path() . '/start/constants.php';

class ControladorProducto extends Controller
{

    public function nuevo()
    {
      $titulo = "Nuevo producto";
      $producto = new Producto();
      $categoria = new Categoria();
      $aCategorias = $categoria->obtenerTodos();
      return view("sistema.producto-nuevo", compact("titulo", "aCategorias", "producto"));  
    }

    public function index()
    {
      $titulo = "Listado de productos";
      return view("sistema.producto-listar", compact("titulo"));
    }


    public function guardar(Request $request) {
      try {
          //Define la entidad servicio
          $titulo = "Modificar producto";
          $entidad = new Producto();
          $entidad->cargarDesdeRequest($request);

          if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta imagen
              $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
              $nombreArchivo = date("Ymdhmsi") . ".$extension";
              $archivo = $_FILES["archivo"]["tmp_name"];
          }

          //validaciones
          if ($entidad->nombre == "" || $entidad->cantidad == "" || $entidad->precio == "" || $entidad->fk_idcategoria == "") {
              $msg["ESTADO"] = MSG_ERROR;
              $msg["MSG"] = "Complete todos los datos";
          } else {
              if ($_POST["id"] > 0) {
                  //Es actualizacion

                  $productAnt = new Producto();
                  $productAnt->obtenerPorId($entidad->idproducto);
                  if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
                      //Eliminar imagen anterior
                      @unlink(env('APP_PATH') . "/public/files/$productAnt->imagen");

                      move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombreArchivo"); //guardaelarchivo
                      $entidad->imagen = $nombreArchivo;
                  } else {
                      $entidad->imagen = $productAnt->imagen;
                  }

                  $entidad->guardar();

                  $msg["ESTADO"] = MSG_SUCCESS;
                  $msg["MSG"] = OKINSERT;
              } else {
                  //Es nuevo

                  if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta imagen
                      move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombreArchivo"); //guardaelarchivo
                      $entidad->imagen = $nombreArchivo;
                  }

                  $entidad->insertar();

                  $msg["ESTADO"] = MSG_SUCCESS;
                  $msg["MSG"] = OKINSERT;
              }
    
              $_POST["id"] = $entidad->idproducto;
              return view('sistema.producto-listar', compact('titulo', 'msg'));
          }
      }
      catch (Exception $e) {
          $msg["ESTADO"] = MSG_ERROR;
          $msg["MSG"] = ERRORINSERT;
      }

      $producto = new Producto();
      $id = $entidad->idproducto;

      if($id > 0){
          $producto->obtenerPorId($id);
      }

      return view('sistema.producto-nuevo', compact('msg', 'producto', 'titulo')) . '?id=' . $producto->idproducto;
    }


    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Producto();
        $aProductos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aProductos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/producto/' . $aProductos[$i]->idproducto . '" class="btn btn-secondary"><i class="far fa-edit"></i></a>';
            $row[] = '<img src="/public/img/'.$aProductos[$i]->imagen.'" class="img-thumbnail">';
            $row[] = $aProductos[$i]->nombre;
            $row[] = $aProductos[$i]->categoria;
            $row[] = $aProductos[$i]->cantidad;
            $row[] = $aProductos[$i]->precio;
            $row[] = $aProductos[$i]->descripcion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aProductos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aProductos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($id){
        $titulo = "Edición de producto";
        $producto = new Producto();
        $producto->obtenerPorId($id);

        $categoria = new Categoria();
        $aCategorias = $categoria->obtenerTodos();
        
        return view('sistema.producto-nuevo', compact('titulo', 'producto', 'aCategorias'));
    }


    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        $pedido = new Pedido();
        $aPedidos = $pedido->obtenerPorProducto($id);

        if (count($aPedidos) == 0) {
            $entidad = new Producto();
            $entidad->obtenerPorId($id);
            $entidad->eliminar();
            @unlink(env('APP_PATH') . "/public/files/$entidad->imagen");

            $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            $aResultado["mensaje"] = "Eliminado correctamente";
        } else {
            $aResultado["err"] = EXIT_FAILURE;
            $aResultado["mensaje"] = "No se puede eliminar un producto con pedidos asociados";
        }
        echo json_encode($aResultado);
    }

}