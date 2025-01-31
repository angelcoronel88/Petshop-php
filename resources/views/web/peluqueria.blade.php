@extends('web.plantilla-usuario')
@section('contenido')



    <!-- Page Header Start -->
    <div class="container-fluid page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="display-3 mb-3 animated slideInDown text-secondary">Peluqueria</h1>

        </div>
    </div>
    <!-- Page Header End -->


    <!-- About Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <!-- Video en lugar de imagen -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-video position-relative overflow-hidden p-5 pe-0">
                    <video class="w-100 rounded-4 shadow-sm" controls autoplay muted loop>
                        <source src="web/videos/peluqueria-presentacion.mp4" type="video/mp4">
                        Tu navegador no soporta el video.
                    </video>
                </div>
            </div>
            <!-- Contenido de texto -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="mb-4">El cuidado del pelo de tu mascota es esencial para mantenerla linda y saludable. En VetLife ofrecemos baños, cortes y peinados que combinan estos dos aspectos fundamentales para el bienestar de tu mascota.</p>
            </div>
        </div>
    </div>
</div>

    <!-- About End -->




   <!-- Feature Start -->
<div class="container-fluid bg-light py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Servicios</h1>
        </div>
        <div class="container my-5">
    <div class="row align-items-center mb-4">
        <div class="col-md-3 text-center">
            <img src="web/img/peluqueria1.jpg" class="img-fluid rounded-circle shadow" width="200" height="200">
        </div>
        <div class="col-md-9">
            <h4 class="text-uppercase text-orange fw-bold">Corte y Baño Completo</h4>
            <p>Incluye baño con shampoo natural, secado, corte a máquina y/o tijera, peinado, limpieza de oídos y corte de uñas.</p>
        </div>
    </div>
    <div class="row align-items-center mb-4">
        <div class="col-md-3 text-center">
            <img src="web/img/peluqueria2.jpg" class="img-fluid rounded-circle shadow" width="200" height="200">
        </div>
        <div class="col-md-9">
            <h4 class="text-uppercase text-orange fw-bold">Baño Medicado</h4>
            <p>Baño con productos especiales que previenen y combaten en tu mascota la presencia de pulgas, piojos y garrapatas.</p>
        </div>
    </div>
    <div class="row align-items-center mb-4">
        <div class="col-md-3 text-center">
            <img src="web/img/peluqueria3.jpg" class="img-fluid rounded-circle shadow" width="200" height="200">
        </div>
        <div class="col-md-9">
            <h4 class="text-uppercase text-orange fw-bold">Baño Hipoalergénico</h4>
            <p>Pensado especialmente para mascotas con piel delicada. Incluye baño con shampoo hipoalergénico, secado y peinado.</p>
        </div>
    </div>
    <div class="row align-items-center mb-4">
        <div class="col-md-3 text-center">
            <img src="web/img/peluqueria4.jpg" class="img-fluid rounded-circle shadow" width="200" height="200">
        </div>
        <div class="col-md-9">
            <h4 class="text-uppercase text-orange fw-bold">Deslanado</h4>
            <p>Es la opción ideal para que nuestras mascotas no pasen calor, consiste en retirar el subpelo muerto. No es doloroso para la mascota.</p>
        </div>
    </div>
    <div class="row align-items-center mb-4">
        <div class="col-md-3 text-center">
            <img src="web/img/peluqueria2.jpg" class="img-fluid rounded-circle shadow" width="200" height="200">
        </div>
        <div class="col-md-9">
            <h4 class="text-uppercase text-orange fw-bold">Cortes De Raza</h4>
            <p>Schnauzer, Caniche, Cocker Spaniel, Cocker Americano, Golden Retriever, Bichón, Border Collie, Fox Terrier, Yorkshire Terrier, Boyero de Berna, Chow Chow, Husky Siberiano, etc.</p>
        </div>
    </div>
    <div class="row align-items-center mb-4">
        <div class="col-md-3 text-center">
            <img src="web/img/peluqueria5.jpg" class="img-fluid rounded-circle shadow" width="200" height="200">
        </div>
        <div class="col-md-9">
            <h4 class="text-uppercase text-orange fw-bold">Baño Para Pequeñas Mascotas</h4>
            <p>Disponible para mascotas de hasta 6 meses. Un delicado baño a mano, con shampoo natural y un suave secado para mimar a tu cachorro.</p>
        </div>
    </div>
    <div class="row align-items-center mb-4">
        <div class="col-md-3 text-center">
            <img src="web/img/peluqueria6.png" class="img-fluid rounded-circle shadow" width="200" height="200">
        </div>
        <div class="col-md-9">
            <h4 class="text-uppercase text-orange fw-bold">Corte De Uñas</h4>
            <p>Previene heridas e infecciones por rotura de uñas y mantiene suaves las patitas de tu mascota.</p>
        </div>
    </div>
</div>
    </div>
</div>

<!-- Feature End -->


@endsection  