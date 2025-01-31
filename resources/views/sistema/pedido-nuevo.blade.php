@extends("plantilla")
@section("titulo", $titulo)
@section('scripts')
<script>
    globalId = '<?php echo isset($pedido->idpedido) && $pedido->idpedido > 0 ? $pedido->idpedido : 0; ?>';
    <?php $globalId = isset($pedido->idpedido) ? $pedido->idpedido : "0";?>
</script>
@endsection
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="/admin/home">Inicio</a></li>
    <li class="breadcrumb-item"><a href="/admin/pedidos">Pedidos</a></li>
    <li class="breadcrumb-item active">Nuevo</li>
</ol>
<ol class="toolbar">
    <li class="btn-item"><a title="Nuevo" href="/admin/pedido/nuevo" class="fa fa-plus-circle" aria-hidden="true"><span>Nuevo</span></a></li>
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-floppy-o" aria-hidden="true" onclick="javascript: $('#modalGuardar').modal('toggle');"><span>Guardar</span></a>
    </li>
    @if($globalId > 0)
    <li class="btn-item"><a title="Guardar" href="#" class="fa fa-trash-o" aria-hidden="true" onclick="javascript: $('#mdlEliminar').modal('toggle');"><span>Eliminar</span></a></li>
    @endif
    <li class="btn-item"><a title="Salir" href="#" class="fa fa-arrow-circle-o-left" aria-hidden="true" onclick="javascript: $('#modalSalir').modal('toggle');"><span>Salir</span></a></li>
</ol>
<script>
function fsalir(){
    location.href ="/admin/pedidos";
}
</script>
@endsection
@section('contenido')
<?php
if (isset($msg)) {
    echo '<div id = "msg"></div>';
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
<div class="panel-body">
        <div id = "msg"></div>
        <?php
if (isset($msg)) {
    echo '<script>msgShow("' . $msg["MSG"] . '", "' . $msg["ESTADO"] . '")</script>';
}
?>
        <form id="form1" method="POST">
            <div class="row">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>
                <div class="form-group col-lg-6">
                    <label>Fecha:*</label>
                    <input type="date" id="txtFecha" name="txtFecha" class="form-control" value="" style = "width:200px" required>
                </div>
                <div class="form-group col-lg-6">
                    <label>Descripcion:*</label>
                    <input type="text" id="txtDescripcion" name="txtDescripcion" class="form-control" value="">
                </div>
                <div class="form-group col-lg-6">
                    <label>Total:*</label>
                    <input type="text" id="txtTotal" name="txtTotal" class="form-control" value="" required>
                </div>
                <div class="form-group col-lg-6">
                   <label>Sucursal</label>
                        <select name="lstSucursal" id="lstSucursal" class="form-control" value="">
                              <option selected disable value="">Seleccionar</option>
                            @foreach($aSucursales as $sucursal)
                              <option value="{{ $sucursal->$idsucursal }}">{{ $sucursal->nombre }}</option>
                            @endforeach 
                        </select>
                </div>
                <div class="form-group col-lg-6">
                    <label>Cliente</label>
                    <select name="lstCliente" id="lstCliente" class="form-control">
                        <option selected disable value="">Seleccionar</option>
                        @foreach($aClientes as $cliente)
                            @if ($cliente->idcliente == $pedido->fk_idcliente)
                            <option value="{{ $cliente->idcliente }}" selected>{{ $cliente->nombre }}</option>
                             @else 
                             <option value="{{ $cliente->idcliente }}">{{ $cliente->nombre }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-6">
                   <label>Estado</label>
                   <select name="lstEstado" id="lstEstado" class="form-control" name="" id="">
                        <option selected value="">Seleccionar</option>
                        @foreach($aEstados as $estado)
                            @if ($estado->idestado == $pedido->fk_estado)
                            <option value="{{ $estado->idestado }}" selected>{{ $estado->nombre }}</option>
                            @else
                            <option value="{{ $estado->idestado }}">{{$estado->nombre}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
</div>
<div class="modal fade" id="mdlEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eliminar registro?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">¿Deseas eliminar el registro actual?</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary" onclick="eliminar();">Sí</button>
          </div>
        </div>
      </div>
    </div>
<script>

    $("#form1").validate();

    function guardar() {
        if ($("#form1").valid()) {
            modificado = false;
            form1.submit();
        } else {
            $("#modalGuardar").modal('toggle');
            msgShow("Corrija los errores e intente nuevamente.", "danger");
            return false;
        }
    }

    function eliminar() {
        $.ajax({
            type: "GET",
            url: "{{ asset('admin/pedido/eliminar') }}",
            data: { id:globalId },
            async: true,
            dataType: "json",
            success: function (data) {
                if (data.err = 0) {
                    msgShow(data.mensaje, "success");
                    $("#btnEnviar").hide();
                    $("#btnEliminar").hide();
                    $('#mdlEliminar').modal('toggle');
                } else {
                    msgShow(data.mensaje, "danger");
                    $('#mdlEliminar').modal('toggle');
                }
            }
        });
    }

</script>
@endsection