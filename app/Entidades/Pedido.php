<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido', 'fecha', 'descripcion', 'total', 'fk_idsucursal', 'fk_idcliente', 'fk_idestado',
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idpedido = $request->input("id");
        $this->fecha = $request->input("txtFecha");
        $this->descripcion = $request->input("txtDescripcion");
        $this->total = $request->input("txtTotal");
        $this->fk_idsucursal = $request->input("lstSucursal");
        $this->fk_idcliente = $request->input("lstCliente");
        $this->fk_idestado = $request->input("lstEstado");
    }


    public function insertar()
    {
        $sql = "INSERT INTO pedidos (
                fecha,
                descripcion,
                total,
                fk_idsucursal,
                fk_idcliente,
                fk_idestado
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fecha,
            $this->descripcion,
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idcliente,
            $this->fk_idestado
        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }

    public function guardar() 
    {
      $sql = "UPDATE pedidos SET
            fecha=?,
            descripcion=?,
            total=?,
            fk_idsucursal=?,
            fk_idcliente=?,
            fk_idestado=?,
          WHERE idpedido=?";
      $affected = DB::update($sql, [
            $this->fecha,
            $this->descripcion,
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idcliente,
            $this->fk_idestado,
            $this->idpedido
            ]);
    }


    public function eliminar()
    {
       $sql = "DELETE FROM pedidos WHERE
              idpedido=?";
            $affected = DB::delete($sql, [$this->idpedido]);
    }

    

    

    public function obtenerTodos()
    {
        $sql = "SELECT
                  idpedido,
                  fecha,
                  descripcion,
                  total,
                  fk_idsucursal,
                  fk_idcliente,
                  fk_idestado,
                FROM pedidos ORDER BY fecha";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorCliente($idCliente)
    {
        $sql = "SELECT
		        A.idpedido,
                A.fecha,
                A.descripcion,
                A.total,
                A.fk_idsucursal,
         
                A.fk_idcliente,
                A.fk_idestado,
                C.nombre AS estado
                FROM pedidos A
               
                INNER JOIN estados C ON C.idestado = A.fk_idestado
                WHERE A.fk_idcliente = $idCliente";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorProducto($idProducto)
    {
        $sql = "SELECT
		    P.idpedido,
            P.fecha,
            P.descripcion,
            P.total,
            P.fk_idsucursal,
            P.fk_idcliente,
            P.fk_idestado,
            PP.cantidad,
            PP.precio_unitario,
            PP.total,
            PP.fk_idproducto
            FROM pedidos P
            INNER JOIN pedidos_productos PP ON P.idpedido = PP.fk_idpedido
            WHERE PP.fk_idproducto = $idProducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    // public function obtenerPorSucursal($idSucursales)
    // {
    //     $sql = "SELECT
	// 	    idpedido,
    //             fecha,
    //             descripcion,
    //             total,
    //             fk_idsucursal,
    //             fk_idcliente,
    //             fk_idestado
    //             FROM pedidos WHERE fk_idsucursal = $idSucursales";
    //     $lstRetorno = DB::select($sql);
    //     return $lstRetorno;
    // }



    public function obtenerPorId($idpedido)
    {
        $sql = "SELECT
                  idpedido
                  fecha,
                  descripcion,
                  total,
                  fk_idsucursal,
                  fk_idcliente,
                  fk_idestado
                FROM pedidos WHERE idpedido = $idpedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            return $this;
        }
        return null;
    }


    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idpedido',
            1 => 'A.idpedido',
            2 => 'B.direccion',
            3 => 'C.nombre',
            4 => 'C.celular',
            5 => 'A.total',
            6 => 'D.nombre',
        );
        $sql = "SELECT DISTINCT
                    A.idpedido,
                    A.fecha,
                    A.descripcion,
                    A.fk_idsucursal,
                    B.direccion AS sucursal,
                    A.fk_idcliente,
                    C.nombre AS cliente,
                    C.celular,-
                    A.fk_idestado,
                    D.nombre AS estado,
                    A.total
                    FROM pedidos A
                    INNER JOIN sucursales B ON A.fk_idsucursal = B.idsucursal
                    INNER JOIN clientes C ON A.fk_idcliente = C.idcliente
                    INNER JOIN estados D ON A.fk_idestado = D.idestado
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.idpedido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR C.celular LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.fecha LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.total LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR D.nombre LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}
