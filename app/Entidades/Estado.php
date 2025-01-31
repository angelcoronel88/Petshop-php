<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    public $timestamps = false;

    protected $fillable = [
        'idestado', 'nombre',
    ];

    protected $hidden = [

    ];


    public function insertar()
    {
        $sql = "INSERT INTO estados (
                nombre
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->nombre
        ]);
        return $this->idestado = DB::getPdo()->lastInsertId();
    }

    public function guardar() 
    {
      $sql = "UPDATE estados SET
            nombre=?,
          WHERE idestado=?";
      $affected = DB::update($sql, [
            $this->nombre,
            $this->idestado
            ]);
    }


    public function eliminar()
      {
       $sql = "DELETE FROM estados WHERE
              idestado=?";
            $affected = DB::delete($sql, [$this->idestado]);
      }

    

    

    public function obtenerTodos()
    {
        $sql = "SELECT
                idestado,
                nombre
                FROM estados ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idestado)
    {
        $sql = "SELECT
                idestado
                nombre
                FROM estados WHERE idestado = $idestado";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idestado = $lstRetorno[0]->idestado;
            $this->nombre = $lstRetorno[0]->nombre;
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
