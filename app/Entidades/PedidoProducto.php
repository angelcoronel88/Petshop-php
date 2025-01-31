<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class PedidoProducto extends Model
{
    protected $table = 'pedidos_productos';
    public $timestamps = false;

    protected $fillable = [
        'idpedidoproducto', 'fk_idproducto', 'fk_idpedido', 'cantidad', 'precio_unitario', 'total',
    ];

    protected $hidden = [

    ];


    public function insertar()
    {
        $sql = "INSERT INTO pedidos_productos (
                cantidad,
                precio_unitario,
                total,
                fk_idpedido,
                fk_idproducto
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->cantidad,
            $this->precio_unitario,
            $this->total,
            $this->fk_idpedido,
            $this->fk_idproducto
        ]);
        return $this->idpedidoproducto = DB::getPdo()->lastInsertId();
    }

    public function guardar() 
    {
      $sql = "UPDATE pedidos_productos SET
            cantidad=?,
            precio_unitario=?,
            total=?,
            fk_idpedido=?,
            fk_idproducto=?,
          WHERE idpedidoproducto=?";
      $affected = DB::update($sql, [
            $this->cantidad,
            $this->precio_unitario,
            $this->total,
            $this->fk_idpedido,
            $this->fk_idproducto,
            $this->idpedidoproducto
            ]);
    }


    public function eliminar()
      {
       $sql = "DELETE FROM pedidos_productos WHERE
              idpedidoproducto=?";
            $affected = DB::delete($sql, [$this->idpedidoproducto]);
      }

    

    

    public function obtenerTodos()
    {
        $sql = "SELECT
                idpedidoproducto
                cantidad,
                precio_unitario,
                total,
                fk_idpedido,
                fk_idproducto
                FROM pedidos_productos ORDER BY cantidad";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idpedidoproducto)
    {
        $sql = "SELECT
                idpedidoproducto
                cantidad,
                precio_unitario,
                total,
                fk_idpedido,
                fk_idproducto
                FROM pedidos_productos WHERE idpedidoproducto = $idpedidoproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedidoproducto = $lstRetorno[0]->idpedidoproducto;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio_unitario = $lstRetorno[0]->precio_unitario;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            return $this;
        }
        return null;
    }


    public function obtenerMenuPadre()
    {
        $sql = "SELECT DISTINCT
                  A.idmenu,
                  A.nombre
                FROM sistema_menues A
                WHERE A.id_padre = 0 OR A.id_padre IS NULL ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerSubMenu($idmenu = null)
    {
        if ($idmenu) {
            $sql = "SELECT DISTINCT
                      A.idmenu,
                      A.nombre
                    FROM sistema_menues A
                    WHERE A.idmenu <> '$idmenu' ORDER BY A.nombre";
            $resultado = DB::select($sql);
        } else {
            $resultado = $this->obtenerTodos();
        }
        return $resultado;
    }

   
    

    

    public function obtenerMenuDelGrupo($idGrupo)
    {
        $sql = "SELECT DISTINCT
        A.idmenu,
        A.nombre,
        A.id_padre,
        A.orden,
        A.url,
        A.css
        FROM sistema_menues A
        INNER JOIN sistema_menu_area B ON A.idmenu = B.fk_idmenu
        WHERE A.activo = '1' AND B.fk_idarea = $idGrupo ORDER BY A.orden";
        $resultado = DB::select($sql);
        return $resultado;
    }


    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'B.nombre',
            2 => 'A.url',
            3 => 'A.activo',
        );
        $sql = "SELECT DISTINCT
                    A.idmenu,
                    A.nombre,
                    B.nombre as padre,
                    A.url,
                    A.activo
                    FROM sistema_menues A
                    LEFT JOIN sistema_menues B ON A.id_padre = B.idmenu
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.url LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}
