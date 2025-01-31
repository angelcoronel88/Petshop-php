<?php

namespace App\Http\Controllers;

use App\Entidades\Categoria;
use App\Entidades\Producto;
use Illuminate\Http\Request;

include_once app_path() . '/start/constants.php';

class ControladorCategoria extends Controller
{

    public function nuevo()
    {
      $titulo = "Nuevo categoria";
      $categoria = new Categoria();
      return view("sistema.categoria-nuevo", compact("titulo", "categoria"));  
    }

    public function index()
    {
      $titulo = "Listado de categorias";
      return view("sistema.categoria-listar", compact("titulo"));
    }


    public function guardar(Request $request) {
      try {
          //Define la entidad servicio
          $titulo = "Modificar categoria";
          $entidad = new Categoria();
          $entidad->cargarDesdeRequest($request);

          //validaciones
          if ($entidad->nombre == "" ) {
              $msg["ESTADO"] = MSG_ERROR;
              $msg["MSG"] = "Complete todos los datos";
          } else {
              if ($_POST["id"] > 0) {
                  //Es actualizacion
                  $entidad->guardar();

                  $msg["ESTADO"] = MSG_SUCCESS;
                  $msg["MSG"] = OKINSERT;
              } else {
                  //Es nuevo
                  $entidad->insertar();

                  $msg["ESTADO"] = MSG_SUCCESS;
                  $msg["MSG"] = OKINSERT;
              }
      
              $_POST["id"] = $entidad->idcategoria;
              return view('sistema.categoria-listar', compact('titulo', 'msg'));
          }
      } catch (Exception $e) {
      $msg["ESTADO"] = MSG_ERROR;
      $msg["MSG"] = ERRORINSERT;

      $categoria = new Categoria();
      $id = $entidad->idcategoria;

      if($id > 0){
        $categoria->obtenerPorId($id);
      }

      return view('sistema.categoria-nuevo', compact('msg', 'categoria', 'titulo')) . '?id=' . $categoria->idcategoria;

  }

  $categoria = new Categoria();
  $id = $entidad->idcategoria;

  if($id > 0){
    $categoria->obtenerPorId($id);
  }

  return view('sistema.categoria-nuevo', compact('msg', 'categoria', 'titulo')) . '?id=' . $categoria->idcategoria;

 }


 public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Categoria();
        $aCategorias = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aCategorias) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/categoria/' . $aCategorias[$i]->idcategoria . '" class="btn btn-secondary"><i class="far fa-edit"></i></a>';
            $row[] = $aCategorias[$i]->nombre;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aCategorias), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aCategorias), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function editar($id){
        $titulo = "Edición de Categoria";
        $categoria = new Categoria();
        $categoria->obtenerPorId($id);
        return view('sistema.categoria-nuevo', compact('titulo', 'categoria'));
    }


    public function eliminar(Request $request)
  {
      $id = $request->input('id');

      $producto = new Producto();
      $aProductos = $producto->obtenerPorCategoria($id);

      if (count($aProductos) == 0) {
          $entidad = new Categoria();
          $entidad->idcategoria = $id;
          $entidad->eliminar();

          $aResultado["err"] = OKINSERT; //eliminado correctamente
          $aResultado["mensaje"] = "Eliminado correctamente";
      } else {
          $aResultado["err"] = EXIT_FAILURE;
          $aResultado["mensaje"] = "No se pudo eliminar esta categoría";

      }
      echo json_encode($aResultado);
  }

}
