<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carritos';
    public $timestamps = false;

    protected $fillable = [
        'idcarrito', 'fk_idcliente',
    ];

    protected $hidden = [

    ];


    public function insertar()
    {
        $sql = "INSERT INTO carritos (
                fk_idcliente
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->fk_idcliente
        ]);
        return $this->idcarrito = DB::getPdo()->lastInsertId();
    }

    public function guardar() 
    {
      $sql = "UPDATE carritos SET
            fk_idcliente=?,
          WHERE idcarrito=?";
      $affected = DB::update($sql, [
            $this->fk_idcliente,
            $this->idcarrito
            ]);
    }


    public function eliminar()
      {
       $sql = "DELETE FROM carritos WHERE
              idcarrito=?";
            $affected = DB::delete($sql, [$this->idcarrito]);
      }

    

    

    public function obtenerTodos()
    {
        $sql = "SELECT
                idcarrito,
                fk_idcliente
                FROM carritos ORDER BY fk_idcliente";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idcarrito)
    {
        $sql = "SELECT
                idcarrito,
                fk_idcliente
                FROM carritos WHERE idcarrito = $idcarrito";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            return $this;
        }
        return null;
    }

    public function obtenerPorCliente($idcliente)
    {
        $sql = "SELECT
                    idcarrito,
                    fk_idcliente
                FROM carritos WHERE fk_idcliente = $idcliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            return $this;
        }
        return null;
    }
    

}
