<?php

namespace App\Http\Controllers;

use App\Entidades\Postulacion;
use Illuminate\Http\Request;

include_once app_path() . '/start/constants.php';

class ControladorPostulacion extends Controller
{

    public function nuevo()
    {
      $titulo = "Nueva postulacion";
      $postulacion = new Postulacion();
      return view("sistema.postulacion-nuevo", compact("titulo", "postulacion"));  
    }

    public function index()
    {
      $titulo = "Listado de postulaciones";
      return view("sistema.postulacion-listar", compact("titulo"));
    }


    public function guardar(Request $request) {

      try {
          //Define la entidad servicio
          $titulo = "Modificar postulacion";
          $entidad = new Postulacion();
          $entidad->cargarDesdeRequest($request);

          if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta archivo
            $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
             $nombreArchivo = date("Ymdhmsi") . ".$extension";
             $archivo = $_FILES["archivo"]["tmp_name"];

            }

          //validaciones
          if ($entidad->nombre == "" || $entidad->apellido == "" || $entidad->celular == "" || $entidad->correo == "") {
              $msg["ESTADO"] = MSG_ERROR;
              $msg["MSG"] = "Complete todos los datos";

          } else {
              if ($_POST["id"] > 0) {
                
                    $postulacionAnt = new Postulacion();
                    $postulacionAnt->obtenerPorId($entidad->idpostulacion);

                    if($_FILES["archivo"]["error"] === UPLOAD_ERR_OK){
                        //Eliminar archivo anterior
                        @unlink(env('APP_PATH') . "/public/files/$postulacionAnt->imagen"); 
                        
                        move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombreArchivo"); //guardaelarchivo
                        $entidad->imagen = $nombreArchivo;
                    } else {
                        $entidad->imagen = $postulacionAnt->imagen;
                    }


                  //Es actualizacion
                  $entidad->guardar();

                  $msg["ESTADO"] = MSG_SUCCESS;
                  $msg["MSG"] = OKINSERT;
              } else {
                  //Es nuevo

                  if ($_FILES["archivo"]["error"] === UPLOAD_ERR_OK) { //Se adjunta archivo
                    move_uploaded_file($archivo, env('APP_PATH') . "/public/files/$nombreArchivo"); //guardaelarchivo
                    $entidad->imagen = $nombreArchivo;
                }
                  $entidad->insertar();

                  $msg["ESTADO"] = MSG_SUCCESS;
                  $msg["MSG"] = OKINSERT;
              }
      
              $_POST["id"] = $entidad->idpostulacion;
              return view('sistema.postulacion-listar', compact('titulo', 'msg'));
          }
      } catch (Exception $e) {
          $msg["ESTADO"] = MSG_ERROR;
          $msg["MSG"] = ERRORINSERT;
      }

      $postulacion = new Postulacion();
      $id = $entidad->idpostulacion;

      if($id > 0){
        $postulacion->obtenerPorId($id);
      }

      return view('sistema.postulacion-nuevo', compact('msg', 'postulacion', 'titulo')) . '?id=' . $postulacion->idpostulacion;

  }


  public function cargarGrilla()
  {
      $request = $_REQUEST;

      $entidad = new Postulacion();
      $aPostulaciones = $entidad->obtenerFiltrado();

      $data = array();
      $cont = 0;

      $inicio = $request['start'];
      $registros_por_pagina = $request['length'];


      for ($i = $inicio; $i < count($aPostulaciones) && $cont < $registros_por_pagina; $i++) {
          $row = array();
          $row[] = '<a href="/admin/postulacion/' . $aPostulaciones[$i]->idpostulacion . '" class="btn btn-secondary"><i class="far fa-edit"></i></a>';
          $row[] = $aPostulaciones[$i]->nombre;
          $row[] = $aPostulaciones[$i]->apellido;
          $row[] = $aPostulaciones[$i]->celular;
          $row[] = $aPostulaciones[$i]->correo;
          $row[] = $aPostulaciones[$i]->curriculum;
          $cont++;
          $data[] = $row;
      }

      $json_data = array(
          "draw" => intval($request['draw']),
          "recordsTotal" => count($aPostulaciones), //cantidad total de registros sin paginar
          "recordsFiltered" => count($aPostulaciones), //cantidad total de registros en la paginacion
          "data" => $data,
      );
      return json_encode($json_data);
  }


  public function editar($id)
  {
    $titulo = "Edición de postulaciones";
    $postulacion = new Postulacion();
    $postulacion->obtenerPorId($id);
    return view('sistema.postulacion-nuevo', compact('titulo', 'postulacion'));
  }


  public function eliminar(Request $request)
    {
        $id = $request->input('id');
        
        
        $postulacion = new Postulacion();
        $postulacion->idpostulacion = $id;
        $postulacion->eliminar();

        $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
        $aResultado["mensaje"] = "Eliminado correctamente";
     
        echo json_encode($aResultado);
    }

}