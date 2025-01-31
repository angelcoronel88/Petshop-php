@extends('web.plantilla-usuario')
@section('contenido')


    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown text-secondary">Iniciar Sesion</h1>
            <!-- Agrega este código después de la etiqueta <h1> -->
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Session Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <h2 class="text-center mb-4">Inicia sesión</h2>
                <p class="text-center mb-4">Ingresa tu correo y clave para acceder a tu cuenta.</p>
                <form action="" method="POST" class="php-email-form mx-auto bg-light p-5 rounded-4 shadow-sm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" name="txtCorreo" class="form-control rounded-pill" id="txtCorreo" placeholder="Correo" required>
                                <label for="txtCorreo"><i class="fas fa-envelope me-2"></i>Correo</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="password" name="txtClave" class="form-control rounded-pill" id="txtClave" placeholder="Clave" required>
                                <label for="txtClave"><i class="fas fa-lock me-2"></i>Clave</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5 shadow-sm" type="submit">Ingresar</button>
                        </div>
                        <div class="col-12 text-center mt-3">
                            <a href="/recuperar-clave" class="text-secondary d-block">¿Olvidaste tu contraseña?</a>
                            <a href="/registrarse" class="text-secondary d-block">¿No tienes cuenta? <strong>Regístrate</strong></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Session End -->


    <!-- Session End -->
 @endsection