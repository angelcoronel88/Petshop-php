<?php

namespace App\Http\Controllers;

use App\Entidades\Cliente;
use App\Entidades\Pedido;
use Illuminate\Http\Request;

include_once app_path() . '/start/constants.php';

class ControladorCliente extends Controller
{

    public function nuevo()
    {
      $titulo = "Nuevo cliente";
      $cliente = new Cliente();
      return view("sistema.cliente-nuevo", compact("titulo", "cliente"));  
    }

    public function index()
    {
      $titulo = "Listado de clientes";
      return view("sistema.cliente-listar", compact("titulo"));
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar cliente";
            $entidad = new Cliente();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->nombre == "" || $entidad->apellido == "" || $entidad->correo == "" || $entidad->dni == "" || $entidad->celular == "" || $entidad->clave == "") {
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

                $_POST["id"] = $entidad->idcliente;
                return view('sistema.cliente-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $entidad) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $cliente = new Cliente();
        $id = $entidad->idcliente;

        if ($id > 0) {
            $cliente->obtenerPorId($id);
        }

        return view('sistema.cliente-nuevo', compact('msg', 'cliente', 'titulo')) . '?id=' . $cliente->idcliente;
    }


    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Cliente();
        $aClientes = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        for ($i = $inicio; $i < count($aClientes) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/cliente/' . $aClientes[$i]->idcliente . '" class="btn btn-secondary"><i class="far fa-edit"></i></a>';
            $row[] = $aClientes[$i]->nombre;
            $row[] = $aClientes[$i]->apellido;
            $row[] = $aClientes[$i]->celular;
            $row[] = $aClientes[$i]->correo;
            $row[] = $aClientes[$i]->dni;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aClientes), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aClientes), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }


    public function editar($id)
    {
        $titulo = "Edición de cliente";
        $cliente = new Cliente();
        $cliente->obtenerPorId($id);
        return view('sistema.cliente-nuevo', compact('titulo', 'cliente'));
    }


    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        $pedido = new Pedido();
        $aPedidos = $pedido->obtenerPorCliente($id);

        if (count($aPedidos) == 0) {
            $entidad = new Cliente();
            $entidad->idcliente = $id;
            $entidad->eliminar();

            $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            $aResultado["mensaje"] = "Eliminado correctamente";
        } else {
            $aResultado["err"] = EXIT_FAILURE;
            $aResultado["mensaje"] = "No se puede eliminar un cliente con pedidos asociados";

        }
        echo json_encode($aResultado);
    }

}
