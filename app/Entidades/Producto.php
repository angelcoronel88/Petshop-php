<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    public $timestamps = false;
    protected $fillable = [
        'idproducto',
        'nombre',
        'cantidad',
        'precio',
        'imagen',
        'fk_idcategoria',
        'descripcion',
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idproducto = $request->input("id");
        $this->nombre = $request->input("txtNombre");
        $this->cantidad = $request->input("txtCantidad");
        $this->precio = $request->input("txtPrecio");
        $this->imagen = '';
        $this->fk_idcategoria = $request->input("lstCategoria");
        $this->descripcion = $request->input("txtDescripcion");
    }

    public function insertar()
    {
        $sql = "INSERT INTO productos (
                nombre,
                cantidad,
                precio,
                imagen,
                fk_idcategoria,
                descripcion
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->cantidad,
            $this->precio,
            $this->imagen,
            $this->fk_idcategoria,
            $this->descripcion
        ]);
        return $this->idproducto = DB::getPdo()->lastInsertId();
        // lo de arriba es para obtener el ultimo id insertado y almacenarlo en this id
    }

    public function guardar()
    {
        $sql = "UPDATE productos SET
            nombre=?,
            cantidad=?,
            precio=?,
            imagen=?,
            fk_idcategoria=?,
            descripcion=?
            WHERE idproducto=?";
        $affected = DB::update($sql, [
            $this->nombre,
            $this->cantidad,
            $this->precio,
            $this->imagen,
            $this->fk_idcategoria,
            $this->descripcion,
            $this->idproducto
        ]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM productos WHERE
            idproducto=?";
        $affected = DB::delete($sql, [$this->idproducto]);
    }


    public function obtenerTodos()
    {
        $sql = "SELECT
                idproducto,
	            nombre,
                cantidad,
                precio,
                imagen,
                fk_idcategoria,
                descripcion
                FROM productos ORDER BY nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorCategoria($idCategoria)
    {
        $sql = "SELECT
		    idproducto,
                nombre,
                descripcion,
                cantidad,
                precio,
                imagen,
                fk_idcategoria            
                FROM productos WHERE fk_idcategoria = $idCategoria";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idproducto)
    {
        $sql = "SELECT
                idproducto,
	            nombre,
                cantidad,
                precio,
                imagen,
                fk_idcategoria,
                descripcion
                FROM productos WHERE idproducto = $idproducto";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idproducto = $lstRetorno[0]->idproducto;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->cantidad = $lstRetorno[0]->cantidad;
            $this->precio = $lstRetorno[0]->precio;
            $this->imagen = $lstRetorno[0]->imagen;
            $this->fk_idcategoria = $lstRetorno[0]->fk_idcategoria;
            $this->descripcion = $lstRetorno[0]->descripcion;
            return $this;
        }
        return null;
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.idproducto',
            1 => 'A.imagen',
            2 => 'A.nombre',
            3 => 'A.descripcion',
            4 => 'B.nombre',
            5 => 'A.cantidad',
            6 => 'A.precio'
        );
        $sql = "SELECT DISTINCT
                    A.idproducto,
                    A.nombre,
                    A.descripcion,
                    A.imagen,
                    A.fk_idcategoria,
                    B.nombre AS categoria,
                    A.cantidad,
                    A.precio
                    FROM productos A
                    INNER JOIN categorias B ON A.fk_idcategoria = B.idcategoria
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.cantidad LIKE '%" . $request['search']['value'] . "%' ";
            $sql .= " OR A.precio LIKE '%" . $request['search']['value'] . "%' )";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
}