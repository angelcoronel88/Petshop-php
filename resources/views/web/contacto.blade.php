@extends('web.plantilla-institucional')
@section('contenido')


    <!-- Page Header Start -->
    <div class="container-fluid page-header wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown text-secondary">Contactanos</h1>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Contact Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">VetLife</h1>
            <p>Ponte en contacto con nosotros!</p>
        </div>
        <div class="row g-5 justify-content-center">
            <!-- Contact Information -->
            <div class="col-lg-5 col-md-12 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-primary text-white d-flex flex-column justify-content-center h-100 p-5 rounded-4 shadow-sm">
                    <h5 class="text-white">Teléfono</h5>
                    <p class="mb-5"><i class="fa fa-phone-alt me-3"></i>+54 9 351 489-1540</p>
                    <h5 class="text-white">Correo</h5>
                    <p class="mb-5"><i class="fa fa-envelope me-3"></i>Vetlife@gmail.com</p>
                    <h5 class="text-white">Dirección</h5>
                    <p class="mb-5"><i class="fa fa-map-marker-alt me-3"></i>Villa Carlos Paz, Córdoba, Argentina</p>
                    <h5 class="text-white">Síguenos</h5>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-2" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <p class="mb-4">Envíanos un mensaje para más información acerca de nuestra atención veterinaria o sobre algún producto de interés de nuestro Petshop.</p>
                <form action="" method="POST" class="php-email-form bg-light p-5 rounded-4 shadow-sm">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" name="txtNombre" class="form-control rounded-pill" id="txtNombre" placeholder="Tu nombre" required>
                                <label for="txtNombre"><i class="fas fa-user me-2"></i>Tu nombre</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" name="txtCorreo" class="form-control rounded-pill" id="txtCorreo" placeholder="Tu correo" required>
                                <label for="txtCorreo"><i class="fas fa-envelope me-2"></i>Tu correo</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" name="txtMotivo" class="form-control rounded-pill" id="txtMotivo" placeholder="Motivo" required>
                                <label for="txtMotivo"><i class="fas fa-tag me-2"></i>Motivo</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea name="txtMensaje" class="form-control rounded-4" id="txtMensaje" placeholder="Escribe tu mensaje aquí" style="height: 200px;" required></textarea>
                                <label for="txtMensaje"><i class="fas fa-comment-dots me-2"></i>Mensaje</label>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5 shadow-sm" type="submit">Enviar Mensaje</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->



    <!-- Google Map Start -->
    <div class="container-xxl px-0 wow fadeIn" data-wow-delay="0.1s" style="margin-bottom: -6px;">
        <iframe class="w-100" style="height: 450px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
            frameborder="0" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
    <!-- Google Map End -->

@endsection
    