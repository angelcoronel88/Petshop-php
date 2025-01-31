@extends('web.plantilla-usuario')
@section('contenido')



<!-- Page Header Start -->
<div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
      <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown text-secondary">Carrito</h1>

      </div>
</div>
<!-- Page Header End -->

<!-- Cart Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-8 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <p class="mb-4 text-center">Revisa los productos en tu carrito y completa tu pedido.</p>
                <form action="" method="post" class="php-email-form bg-light p-5 rounded-4 shadow-sm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <!-- Cart Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-hover text-center align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>Producto</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example row -->
                                <tr>
                                    <td>
                                        <img src="https://via.placeholder.com/80" class="img-thumbnail rounded-circle me-2" alt="Producto">
                                        <span>Nombre del Producto</span>
                                    </td>
                                    <td>$10.00</td>
                                    <td>
                                        <input type="number" class="form-control w-50 mx-auto rounded-pill" value="1" min="1">
                                    </td>
                                    <td>$10.00</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm rounded-circle"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <!-- End Example Row -->
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold">TOTAL:</td>
                                    <td colspan="2" class="text-start">$10.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Payment and Pickup Options -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="lstPago" id="lstPago" class="form-select rounded-pill">
                                    <option value="seleccionar" disabled selected>Seleccionar método de pago</option>
                                    <option value="mercadoPago">Mercado Pago</option>
                                    <option value="efectivo">Efectivo</option>
                                </select>
                                <label for="lstPago"><i class="fas fa-wallet me-2"></i>Método de Pago</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select name="lstSucursal" id="lstSucursal" class="form-select rounded-pill">
                                    <option value="seleccionar" disabled selected>Seleccionar sucursal</option>
                                </select>
                                <label for="lstSucursal"><i class="fas fa-store me-2"></i>Sucursal para retirar</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control rounded-4" name="txtDescripcion" id="txtDescripcion" placeholder="Añadir comentarios..." style="height: 120px;"></textarea>
                                <label for="txtDescripcion"><i class="fas fa-comment-dots me-2"></i>Añadir comentarios</label>
                            </div>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="row g-3 mt-4 text-center">
                        <div class="col-md-6">
                            <button class="btn btn-primary rounded-pill py-3 px-5 w-100 shadow-sm" type="submit">
                                <i class="fas fa-arrow-right me-2"></i>Continuar pedido
                            </button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-secondary rounded-pill py-3 px-5 w-100 shadow-sm" type="submit">
                                <i class="fas fa-check me-2"></i>Finalizar pedido
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->


@endsection