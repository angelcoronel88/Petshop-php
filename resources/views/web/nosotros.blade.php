@extends('web.plantilla-usuario')
@section('contenido')



    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown text-secondary">Nosotros</h1>

        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                        <img class="img-fluid w-100" src="web/img/nosotros-1.jpg">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="display-5 mb-4">VetLife</h1>
                    <p class="mb-4">Brindamos la mejor atención veterinaria para tu mascota. Para ello, seleccionamos los mejores profesionales veterinarios, quienes continúan en capacitación y formación constante, para darle la más cálida y profesional atención a tu mascota</p>
                    <p><i class="fa fa-check text-primary me-3"></i><b>Consultas y diagnóstico:</b> Atendemos tus inquietudes para brindarte la mejor respuesta.</p>
                    <p><i class="fa fa-check text-primary me-3"></i><b>Atención veterinaria</b> para animales domésticos y exóticos</p>
                    <p><i class="fa fa-check text-primary me-3"></i><b>Plan de vacunación completo:</b> acompañamos el sano crecimiento de tu cachorro y completamos su vacunación en su etapa adulta.</p>
                    <p><i class="fa fa-check text-primary me-3"></i><b>Desparasitaciones:</b> Internas y externas</p>
                    <p><i class="fa fa-check text-primary me-3"></i><b>Petshop</b> variedad de productos para tu mascota</p>
                    <p><i class="fa fa-check text-primary me-3"></i><b>Estética canina</b> para mantener a tu mascota limpia y saludable</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->




    <!-- Feature Start -->
    <div class="container-fluid bg-light py-6">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <h1 class="display-5 mb-3">Nuestros especialistas veterinarios</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="web/img/doctor-1.png" alt="">
                        <h4 class="mb-3">Fernando Moyano</h4>
                        <p class="mb-4">Medico Veterinario, especialista en traumatologia y animales exoticos.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="web/img/doctor-2.png" alt="">
                        <h4 class="mb-3">Alejando Fernandez</h4>
                        <p class="mb-4">Medico Veterinario, especialista en dermatologia y alergia.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-white text-center h-100 p-4 p-xl-5">
                        <img class="img-fluid mb-4" src="web/img/doctor-3.png" alt="">
                        <h4 class="mb-3">Monserrat Mendoza</h4>
                        <p class="mb-4">Medica Veterinaria, especialista en cardiologia.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- Session Start -->
<div class="container-xxl py-6">
    <div class="container">
        <div class="row g-5 justify-content-center">
            <div class="col-lg-7 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <h2 class="text-center mb-4">Trabaja con Nosotros</h2>
                <p class="text-center mb-4">Haz parte de nuestra familia VetLife. Ingresa tus datos para realizar la postulacion.</p> 
                <form action="" method="post" class="php-email-form mx-auto bg-light p-5 rounded-4 shadow-sm" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row g-4">
                        <div class="col-12">
                             <div class="form-floating">
                                <input type="text" name="txtNombre" class="form-control rounded-pill" id="txtNombre" placeholder="Tu nombre" required>
                                <label for="txtNombre"><i class="fas fa-user me-2"></i>Tu nombre</label>
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
                                <input type="text" name="txtCelular" class="form-control rounded-pill" id="txtCelular" placeholder="Celular" required>
                                <label for="txtCelular"><i class="fas fa-phone-alt me-2"></i>Celular</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="file" name="archivoCurriculum" class="form-control" id="archivoCurriculum" accept=".pdf, .docx, .doc" required>
                                <p>Se aceptan los formatos: .pdf, .docx, .doc</p>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary rounded-pill py-3 px-5 shadow-sm" type="submit">Postularse</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Session End -->

@endsection  