<?php

namespace App\Http\Controllers;

use App\Entidades\Pedido;
use App\Entidades\Sucursal;
use App\Entidades\Cliente;
use App\Entidades\Estado;
use Illuminate\Http\Request;

include_once app_path() . '/start/constants.php';
class ControladorPedido extends Controller
{

    public function nuevo()
    {
        $titulo = "Nuevo Pedido";
        $pedido = new Pedido();
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cliente = new Cliente();
        $aClientes = $cliente->obtenerTodos();
        $estado = new Estado();
        $aEstados = $estado->obtenerTodos();

        return view("sistema.pedido-nuevo", compact("titulo", "aSucursales", "aClientes", "aEstados", "pedido"));
    }

    public function index()
    {
      $titulo = "Listado de pedidos";
      return view("sistema.pedido-listar", compact("titulo"));
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar cliente";
            $entidad = new Pedido();
            $entidad->cargarDesdeRequest($request);

            //validaciones
            if ($entidad->fecha == "" || $entidad->total == "") {
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
                return view('sistema.pedido-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $pedido = new Pedido();
        $id = $entidad->idpedido;

        if ($id > 0) {
            $pedido->obtenerPorId($id);
        }
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();
        $cliente = new Cliente();
        $aClientes = $cliente->obtenerTodos();
        $estado = new Estado();
        $aEstados = $estado->obtenerTodos();


        return view('sistema.pedido-nuevo', compact('msg', 'pedido', 'titulo', "aSucursales", "aClientes", "aEstados")) . '?id=' . $pedido->idpedido;
    }


    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidad = new Pedido();
        $aPedidos = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aPedidos) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<div class="text-center"><a href="/admin/pedido/' . $aPedidos[$i]->idpedido . '" class="btn btn-primary"><i class="far fa-edit" title="Editar"></i></a></div>';
            $row[] = $aPedidos[$i]->idpedido;
            $row[] = $aPedidos[$i]->sucursal;
            $row[] = $aPedidos[$i]->cliente;
            $row[] = $aPedidos[$i]->celular;
            $row[] = date_format(date_create($aPedidos[$i]->fecha), "d/m/Y");
            $row[] = '$' . number_format(($aPedidos[$i]->total), 2, ',', '.');
            $row[] = '<span style="color:green; font-weight: bold;">' .  $aPedidos[$i]->estado . '</span>';
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPedidos), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPedidos), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }


    public function editar($id)
    {
        $titulo = "Edición de Pedido";
        $pedido = new Pedido();
        $pedido->obtenerPorId($id);


        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos($id);

        $cliente = new Cliente();
        $aClientes = $cliente->obtenerTodos($id);

        $estado = new Estado();
        $aEstados = $estado->obtenerTodos($id);


        return view('sistema.pedido-nuevo', compact('titulo', 'pedido', 'aSucursales', 'aClientes', 'aEstados',));
    }


    public function eliminar(Request $request)
    {
        $id = $request->input('id');
        $entidad = new Pedido();
        $entidad->idpedido = $id;
        $confirmacion = $entidad->obtenerPorId($id);

        if ($confirmacion!=null) {
            $entidad->eliminar();
            $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            $aResultado["mensaje"] = "Eliminado correctamente";
        } else {
            $aResultado["err"] = EXIT_FAILURE;
            $aResultado["mensaje"] = "No se puede eliminar un pedido que no existe";

        }
        echo json_encode($aResultado);
    }

}