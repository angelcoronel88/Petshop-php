<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion', 'nombre', 'apellido', 'celular', 'correo', 'curriculum',
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idpostulacion =  $request->input("id");
        $this->nombre = $request->input("txtNombre");
        $this->apellido = $request->input("txtApellido");
        $this->celular = $request->input("txtCelular");
        $this->correo = $request->input("txtCorreo");
        $this->curriculum = "";
    }


    public function insertar()
    {
        $sql = "INSERT INTO postulaciones (
                nombre,
                apellido,
                celular,
                correo,
                curriculum
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->celular,
            $this->correo,
            $this->curriculum
        ]);
        return $this->idpostulacion = DB::getPdo()->lastInsertId();
    }

    public function guardar() 
    {
      $sql = "UPDATE postulaciones SET
            nombre=?,
            apellido=?,
            celular=?,
            correo=?,
            curriculum=?,
          WHERE idpostulacion=?";
      $affected = DB::update($sql, [
            $this->nombre,
            $this->apellido,
            $this->celular,
            $this->correo,
            $this->curriculum,
            $this->idpostulacion
            ]);
    }


    public function eliminar()
      {
       $sql = "DELETE FROM postulaciones WHERE
              idpostulacion=?";
            $affected = DB::delete($sql, [$this->idpostulacion]);
      }

    

    

    public function obtenerTodos()
    {
        $sql = "SELECT
                idpostulacion
                nombre,
                apellido,
                celular,
                correo,
                curriculum
                FROM postulaciones ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idpostulacion)
    {
        $sql = "SELECT
                idpostulacion
                nombre,
                apellido,
                celular,
                correo,
                curriculum
                FROM postulaciones WHERE idpostulacion = $idpostulacion";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpostulacion = $lstRetorno[0]->idpostulacion;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->celular = $lstRetorno[0]->celular;
            $this->correo = $lstRetorno[0]->correo;
            $this->curriculum = $lstRetorno[0]->curriculum;
            return $this;
        }
        return null;
    }


    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre',
            1 => 'A.apellido',
            2 => 'A.celular',
            3 => 'A.correo',
            4 => 'A.curriculum'
        );
        $sql = "SELECT DISTINCT
                    A.idpostulacion,
                    A.nombre,
                    A.apellido,
                    A.celular,
                    A.correo,
                    A.curriculum
                    FROM postulaciones A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.correo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.celular LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.curriculum LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }


}
