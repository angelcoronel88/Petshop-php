<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    public $timestamps = false;

    protected $fillable = [
        'idsucursal', 'telefono', 'direccion', 'linkmapa',
    ];

    protected $hidden = [

    ];


    public function cargarDesdeRequest($request)
    {
        $this->idsucursal =  $request->input("id");
        $this->telefono = $request->input("txtTelefono");
        $this->linkmap = $request->input("txtLinkmap");
        
        $this->horario = $request->input("txtHorario");
    }


    public function insertar()
    {
        $sql = "INSERT INTO sucursales (
                telefono,
                direccion,
                linkmapa
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->telefono,
            $this->direccion,
            $this->linkmapa
        ]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }

    public function guardar() 
    {
      $sql = "UPDATE sucursales SET
            telefono=?,
            direccion=?,
            linkmapa=?,
          WHERE idsucursal=?";
      $affected = DB::update($sql, [
            $this->telefono,
            $this->direccion,
            $this->linkmapa,
            $this->idsucursal
            ]);
    }


    public function eliminar()
    {
       $sql = "DELETE FROM sucursales WHERE
              idsucursal=?";
            $affected = DB::delete($sql, [$this->idsucursal]);
    }

    

    

    public function obtenerTodos()
    {
        $sql = "SELECT
                idsucursal
                telefono,
                direccion,
                linkmapa
                FROM sucursales ORDER BY idsucursal";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idsucursal)
    {
        $sql = "SELECT
                idsucursal
                telefono,
                direccion,
                linkmapa
                FROM sucursales WHERE idsucursal = $idsucursal";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->linkmapa = $lstRetorno[0]->linkmapa;
            return $this;
        }
        return null;
    }


    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.telefono',
            1 => 'A.direccion',
            2 => 'A.linkmapa',
        );
        $sql = "SELECT DISTINCT
                    A.idsucursal,
                    A.telefono,
                    A.direccion,
                    A.linkmapa
                    FROM sucursales A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.telefono LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.direccion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.linkmapa LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }



}
