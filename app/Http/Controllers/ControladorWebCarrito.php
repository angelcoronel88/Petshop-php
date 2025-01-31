<?php

namespace App\Http\Controllers;

use App\Entidades\CarritoProducto;
use App\Entidades\Cliente;
use App\Entidades\Pedido;
use App\Entidades\Carrito;
use App\Entidades\PedidoProducto;
use App\Entidades\Sucursal;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;

use Session;

class ControladorWebCarrito extends Controller
{
    public function index()
    {
        $sucursal = new Sucursal();
        $aSucursales = $sucursal->obtenerTodos();

        $carritoProducto = new CarritoProducto();

        $idCliente = Session::get("fk_idcliente");
        $cantidadCarrito = "";
        if ($idCliente) {
            $cantidadCarrito = $carritoProducto->obtenerCantidadPorCliente($idCliente);
        }

        //Traer todos los productos del usuario
         $aCarritos = $carritoProducto->obtenerPorCliente($idCliente);

        return view("web.carrito", compact('cantidadCarrito', 'aCarritos'));
    }

    public function confirmarCompra(Request $request)
    {
        $idCliente = Session::get("fk_idcliente");
        $medioDePago = $request->input("lstPago");
        $carritoProducto = new CarritoProducto();
        $pedidoProducto = new PedidoProducto();

        $aCarritos = $carritoProducto->obtenerPorCliente($idCliente);

        $total = 0;
        foreach ($aCarritos as $carrito) {
            $total += $carrito->precio * $carrito->cantidad;
        }

        $pedido = new Pedido();
        $pedido->fecha = date("Y-m-d");
        $pedido->descripcion = $request->input("txtDescripcion");
        $pedido->total = $total;
        $pedido->fk_idcliente = $idCliente;
        $pedido->fk_idestado = 1;//Pendiente
        $pedido->insertar();

        foreach($aCarritos as $carrito){
            $pedidoProducto->fk_idproducto = $carrito->fk_idproducto;
            $pedidoProducto->fk_idpedido = $pedido->idpedido;
            $pedidoProducto->cantidad = $carrito->cantidad;
            $pedidoProducto->total = $carrito->precio * $pedidoProducto->cantidad;
            $pedidoProducto->insertar();
        }
        //Vaciamos el carrito
        $carrito = new Carrito();
        $carritoCliente = $carrito->obtenerPorCliente($idCliente);
        $carritoProducto->eliminarPorCarrito($carritoCliente->idcarrito);
    
        $carrito->eliminarPorCliente($idCliente);

        if($medioDePago == "efectivo"){
            return redirect("/confirmacion-compra");
        } else {

            $access_token = "";
            SDK::setClientId(config("payment-methods.mercadopago.client"));
            SDK::setClientSecret(config("payment-methods.mercadopago.secret"));
            //SDK::setAccessToken($access_token); //Es el token de la cuenta de MP donde se deposita el dinero

            //Armado del producto ‘item’
            $item = new Item();
            $item->id = "1234";
            $item->title = "Burger SRL";
            $item->category_id = "products";
            $item->quantity = 1;
            $item->unit_price = $total;
            $item->currency_id = "ARS"; //COP

            $preference = new Preference();
            $preference->items = array($item);

            //Datos del comprador
            $cliente = new Cliente();
            $cliente->obtenerPorId($idCliente);

            $payer = new Payer();
            $payer->name = $cliente->nombre;
            $payer->surname = $cliente->apellido;
            $payer->email = $cliente->correo;
            $payer->date_created = date('Y-m-d H:m:s');
            $payer->identification = array(
                "type" => "CUIT",
                "number" => $cliente->cedula,
            );
            $preference->payer = $payer;

            //URL de configuración para indicarle a MP
            $preference->back_urls = [
                "success" => "http://127.0.0.1:8000/mercado-pago/aprobado/" . $pedido->idpedido,
                "pending" => "http://127.0.0.1:8000/mercado-pago/pendiente/" . $pedido->idpedido,
                "failure" => "http://127.0.0.1:8000/mercado-pago/error/" . $pedido->idpedido,
            ];

            $preference->payment_methods = array("installments" => 6);
            $preference->auto_return = "all";
            $preference->notification_url = '';
            //$preference->save(); //Ejecuta la transacción
        }
    }
}