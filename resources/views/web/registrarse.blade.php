@extends('web.plantilla-usuario')
@section('contenido')


    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown text-secondary">Registrarse</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Registro Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <h2 class="text-center mb-4">Crea tu cuenta</h2>
                <p class="text-center mb-4">Regístrate para poder ver el estado de tus pedidos.</p>
                <form action="" method="post" class="php-email-form mx-auto bg-light p-5 rounded-4 shadow-sm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="txtNombre" class="form-control rounded-pill" id="txtNombre" placeholder="Nombre" required>
                                <label for="txtNombre"><i class="fas fa-user me-2"></i>Nombre</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="txtApellido" class="form-control rounded-pill" id="txtApellido" placeholder="Apellido" required>
                                <label for="txtApellido"><i class="fas fa-user-tag me-2"></i>Apellido</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" name="txtCorreo" class="form-control rounded-pill" id="txtCorreo" placeholder="Correo" required>
                                <label for="txtCorreo"><i class="fas fa-envelope me-2"></i>Correo</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="txtDni" class="form-control rounded-pill" id="txtDni" placeholder="DNI" required>
                                <label for="txtDni"><i class="fas fa-id-card me-2"></i>DNI</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="txtCelular" class="form-control rounded-pill" id="txtCelular" placeholder="Celular" required>
                                <label for="txtCelular"><i class="fas fa-phone-alt me-2"></i>Celular</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="txtClave" class="form-control rounded-pill" id="txtClave" placeholder="Clave" required>
                                <label for="txtClave"><i class="fas fa-lock me-2"></i>Clave</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="txtConfirmarClave" class="form-control rounded-pill" id="txtConfirmarClave" placeholder="Confirmar Clave" required>
                                <label for="txtConfirmarClave"><i class="fas fa-lock me-2"></i>Confirmar Clave</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5 shadow-sm" type="submit">Registrarse</button>
                        </div>
                        <div class="col-12 text-center">
                            <a href="/iniciar-sesion" class="text-secondary">¿Ya tienes cuenta? <strong>Inicia sesión</strong></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Registro End -->



    <!-- Registro End -->



@endsection