<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = false;

    protected $fillable = [
        'idcliente', 'nombre', 'apellido', 'correo', 'dni', 'celular', 'clave',
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idcliente =  $request->input("id");
        $this->nombre = $request->input("txtNombre");
        $this->apellido = $request->input("txtApellido");
        $this->correo = $request->input("txtCorreo");
        $this->dni = $request->input("txtDni");
        $this->celular = $request->input("txtCelular");
        $this->clave = $request->input("txtClave");
    }


    public function insertar()
    {
        $sql = "INSERT INTO clientes (
                nombre,
                apellido,
                correo,
                dni,
                celular,
                clave
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->correo,
            $this->dni,
            $this->celular,
            $this->clave
        ]);
        return $this->idcliente = DB::getPdo()->lastInsertId();
    }

    public function guardar() 
    {
      $sql = "UPDATE clientes SET
            nombre=?,
            apellido=?,
            correo=?,
            dni=?,
            celular=?,
            clave=?,
          WHERE idcliente=?";
      $affected = DB::update($sql, [
            $this->nombre,
            $this->apellido,
            $this->correo,
            $this->dni,
            $this->celular,
            $this->clave,
            $this->idcliente
            ]);
    }


    public function editar()
    {
        $sql = "UPDATE clientes SET
            nombre=?,
            apellido=?,
            correo=?,
            dni=?,
            celular=?
            WHERE idcliente=?";
        $affected = DB::update($sql, [
            $this->nombre,
            $this->apellido,
            $this->correo,
            $this->dni,
            $this->celular,
            $this->idcliente
            ]);
    }


    public function eliminar()
      {
       $sql = "DELETE FROM clientes WHERE
              idcliente=?";
            $affected = DB::delete($sql, [$this->idcliente]);
    }



    public function obtenerTodos()
    {
        $sql = "SELECT
                idcliente,
                nombre,
                apellido,
                correo,
                dni,
                celular,
                clave
                FROM clientes ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idcliente)
    {
        $sql = "SELECT
                idcliente,
				nombre,
                apellido,
                correo,
                dni,
                celular,
                clave
                FROM clientes WHERE idcliente = $idcliente";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->correo = $lstRetorno[0]->correo;
            $this->dni = $lstRetorno[0]->dni;
            $this->celular = $lstRetorno[0]->celular;
            $this->clave = $lstRetorno[0]->clave;
            return $this;
        }
        return null;
    }


    public function obtenerPorCorreo($correo)
    {
        $sql = "SELECT
                idcliente,
				nombre,
                apellido,
                correo,
                dni,
                celular,
                clave
                FROM clientes WHERE correo = '$correo'";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcliente = $lstRetorno[0]->idcliente;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->apellido = $lstRetorno[0]->apellido;
            $this->correo = $lstRetorno[0]->correo;
            $this->dni = $lstRetorno[0]->dni;
            $this->celular = $lstRetorno[0]->celular;
            $this->clave = $lstRetorno[0]->clave;
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
            4 => 'A.dni'
        );
        $sql = "SELECT DISTINCT
                    A.idcliente,
                    A.nombre,
                    A.apellido,
                    A.correo,
                    A.dni,
                    A.celular
                    FROM clientes A
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.apellido LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.correo LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.celular LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.dni LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }


    

}
