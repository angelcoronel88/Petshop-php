@extends('web.plantilla-usuario')
@section('scripts')
<script>
    globalId = '<?php echo isset($cliente->idcliente) && $cliente->idcliente > 0 ? $cliente->idcliente : 0; ?>';
    <?php $globalId = isset($cliente->idcliente) ? $cliente->idcliente : "0"; ?>

</script>
@endsection
@section('contenido')

    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown text-secondary">Mi Cuenta</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Mi Cuenta Start -->
    <div class="container-xxl py-6">
        <div class="container">
            <div class="row g-5 justify-content-center">
                <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                    <p class="mb-4">Aquí podrás verificar tus datos personales. Edítalos de ser necesario.</p>

                    <form action="" method="post" class="php-email-form d-block mx-auto w-50">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="id" name="id" class="form-control" value="{{$globalId}}" required>

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="txtNombre" class="form-control" id="txtNombre" value="{{$cliente->nombre}}" placeholder="Nombre" data-rule="minlen:3" data-msg="Por favor, ingrese como mínimo 3 letras" required>
                                    <label for="txtNombre">Nombre</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" name="txtApellido" class="form-control" id="txtApellido" value="{{$cliente->apellido}}" placeholder="Apellido" required>
                                    <label for="txtApellido">Apellido</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="txtCelular" id="txtCelular" value="{{$cliente->celular}}" placeholder="Celular" required>
                                    <label for="txtCelular">Celular</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" name="txtCorreo" id="txtCorreo" value="{{$cliente->correo}}" placeholder="Correo" required>
                                    <label for="txtCorreo">Correo</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="txtDni" id="txtDni" value="{{$cliente->dni}}" placeholder="Dni" required>
                                    <label for="txtDni">Dni</label>
                                </div>
                            </div>
                            <div class="col-12 text-start">
                                <a href="/cambiar-clave">Cambiar clave</a>
                            </div>
                            <div class="col-12 d-flex align-items-center">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Guardar</button>
                                <a href="{{ url('/cerrar-sesion') }}" class="btn btn-danger rounded-pill py-3 px-4 ml-3">Cerrar Sesión</a>
                            </div>
                        </div>
                    </form>

                    <div class="section-title mt-5">
                        <h2>Mis <span>Pedidos</span></h2>
                        <p>Estos son tus pedidos activos.</p>
                    </div>
                    <table class="table php-email-form">
                        <thead>
                            <tr>
                                <th>Nro.</th>
                                <th>Fecha</th>
                                <th>Descripción</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aPedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->idpedido }}</td>
                                <td>{{ date_format(date_create($pedido->fecha), "d/m/Y") }}</td>
                                <td>{{ $pedido->descripcion }}</td>
                                <td>${{ $pedido->total }}</td>
                                <td>{{ $pedido->estado }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Mi Cuenta End -->

@endsection
