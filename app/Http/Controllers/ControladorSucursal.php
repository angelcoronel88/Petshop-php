<?php

namespace App\Http\Controllers;

use App\Entidades\Sucursal;
use App\Entidades\Pedido;
use Illuminate\Http\Request;

include_once app_path() . '/start/constants.php';

class ControladorSucursal extends Controller
{

    public function nuevo()
    {
      $titulo = "Nueva sucursal";
      return view("sistema.sucursal-nuevo", compact("titulo"));  
    }

    public function index()
    {
      $titulo = "Listado de sucursales";
      return view("sistema.sucursal-listar", compact("titulo"));
    }


    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar sucursal";
            $entidad = new Sucursal();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->telefono == "" || $entidad->linkmap == "") {
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

                $_POST["id"] = $entidad->idsucursal;
                return view('sistema.sucursal-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $sucursal = new Sucursal();
        $id = $entidad->idsucursal;

        if ($id > 0) {
            $sucursal->obtenerPorId($id);
        }

        return view('sistema.sucursal-nuevo', compact('msg', 'sucursal', 'titulo')) . '?id=' . $sucursal->idsucursal;
    }


    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Sucursal();
        $aSucursal = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aSucursal) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/sucursal/' . $aSucursal[$i]->idsucursal . '" class="btn btn-secondary"><i class="far fa-edit"></i></a>';
            $row[] = $aSucursal[$i]->telefono;
            $row[] = $aSucursal[$i]->linkmap;
            $row[] = $aSucursal[$i]->direccion;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSucursal), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSucursal), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }


    public function editar($id)
    {
        $titulo = "Editar sucursal";
        $sucursal = new Sucursal();
        $sucursal->obtenerPorId($id);
        return view('sistema.sucursal-nuevo', compact('titulo', 'sucursal'));
    }


    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        $pedido = new Pedido();
        $aPedidos = $pedido->obtenerPorSucursal($id);

        if (count($aPedidos) == 0) {
            $entidad = new Sucursal();
            $entidad->idsucursal = $id;
            $entidad->eliminar();

            $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            $aResultado["mensaje"] = "Eliminado correctamente";
        } else {
            $aResultado["err"] = EXIT_FAILURE;
            $aResultado["mensaje"] = "No se puede eliminar un sucursal con pedidos asociados";

        }
        echo json_encode($aResultado);
    }
    

}