<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class CarritoProducto extends Model
{
    protected $table = 'carritos_productos';
    public $timestamps = false;

    protected $fillable = [
        'idcarritoproducto', 'fk_idproducto', 'fk_idcarrito','cantidad',
    ];

    protected $hidden = [

    ];


    public function insertar()
    {
        $sql = "INSERT INTO carritos_productos (
                fk_idproducto,
                fk_idcarrito,
                cantidad
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fk_idproducto,
            $this->fk_idcarrito,
            $this->cantidad
        ]);
        return $this->idcarrito_producto = DB::getPdo()->lastInsertId();
    }

    public function guardar() 
    {
      $sql = "UPDATE carritos_productos SET
            fk_idproducto=?,
            fk_idcarrito=?,
            cantidad=?,
          WHERE idcarritoproducto=?";
      $affected = DB::update($sql, [
            $this->fk_idproducto,
            $this->fk_idcarrito,
            $this->cantidad,
            $this->idcarritoproducto
            ]);
    }


    public function eliminar()
    {
       $sql = "DELETE FROM carritos_productos WHERE
              idcarritoproducto=?";
            $affected = DB::delete($sql, [$this->idcarritoproducto]);
    }

    

    

    public function obtenerTodos()
    {
        $sql = "SELECT
                idcarritoproducto
                fk_idproducto,
                fk_idcarrito,
                cantidad
                FROM carritos_productos ORDER BY idcarritoproducto";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorCliente($idCliente)
    {
        $sql = "SELECT
                A.idcarritoproducto,
                A.fk_idcarrito,
                A.fk_idproducto,
                A.cantidad,
                B.nombre,
                B.precio,
                B.imagen
            FROM carritos_productos A
            INNER JOIN productos B ON A.fk_idproducto = B.idproducto 
            INNER JOIN carritos C ON C.idcarrito  = A.fk_idcarrito 
            WHERE C.fk_idcliente = ?
            ORDER BY idcarritoproducto";
        $lstRetorno = DB::select($sql, [$idCliente]);
        return $lstRetorno;
    }


    public function obtenerPorId($idcarritoproducto)
    {
        $sql = "SELECT
                idcarritoproducto
                fk_idproducto,
                fk_idcarrito,
                cantidad
                FROM carritos_productos WHERE idcarritoproducto = $idcarritoproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarritoproducto = $lstRetorno[0]->idcarritoproducto;
            $this->fk_idproducto = $lstRetorno[0]->fk_idproducto;
            $this->fk_idcarrito = $lstRetorno[0]->fk_idcarrito;
            $this->cantidad = $lstRetorno[0]->cantidad;
            return $this;
        }
        return null;
    }

    public function obtenerCantidadPorCliente($idCliente)
    {
        $sql = "SELECT count(*) AS 'cantidad'
                FROM carritos_productos A
                INNER JOIN carritos B ON A.fk_idcarrito = B.idcarrito
                WHERE fk_idcliente = $idCliente";
        $lstRetorno = DB::select($sql);
        return $lstRetorno[0]->cantidad;
    }


    


}
