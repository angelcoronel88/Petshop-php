@extends('web.plantilla-institucional')
@section('contenido')



<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="w-100" src="web/img/perroygato-42.jpeg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-7">
                                <h1 class="display-2 mb-5 animated slideInDown">Salud y amor por tus mascotas</h1>
                                <a href="/productos" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Productos</a>
                                <a href="/servicios" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Servicios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img class="w-100" src="web/img/banner-5.jpg" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-lg-7">
                                <h1 class="display-2 mb-5 mt-5 animated slideInDown">Petshop:</h1>
                                <h2 class="display-2 mb-5 mt-5 animated slideInDown">Gran variedad</h2>
                                <a href="/productos" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Productos</a>
                                <a href="/servicios" class="btn btn-secondary rounded-pill py-sm-3 px-sm-5 ms-3">Servicios</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->



<!-- Feature Start -->
<div class="container-fluid bg-light my-5 py-6">
    <div class="container">
        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
            <h1 class="display-5 mb-3">Nuestros Servicios</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" src="web/img/veterinario.png" alt="">
                    <h4 class="mb-3">Atencion Veterinaria</h4>
                    <p class="mb-4">Contamos con especialistas altamente calificados.</p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="/nosotros">Saber Mas</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" src="web/img/petshop-3.png" alt="">
                    <h4 class="mb-3">Petshop</h4>
                    <p class="mb-4">Gran Variedad de productos para el cuidado de tu mascosta.</p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="/productos">Saber Mas</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="bg-white text-center h-100 p-4 p-xl-5">
                    <img class="img-fluid mb-4" src="web/img/peluqueria.png" alt="">
                    <h4 class="mb-3">Estetica Canina</h4>
                    <p class="mb-4">Contamos con servicio de peluqueria y estetica canina.</p>
                    <a class="btn btn-outline-primary border-2 py-2 px-4 rounded-pill" href="/peluqueria">Saber Mas</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->


<!-- Product Start -->
<div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <h1 class="display-5 mb-3">Nuestros Productos</h1>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2 active" data-bs-toggle="pill" href="#tab-1">Perros</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-2">Gatos </a>
                        </li>
                        <li class="nav-item me-0">
                            <a class="btn btn-outline-primary border-2" data-bs-toggle="pill" href="#tab-3">Otros</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="product-item">
                                <div class="position-relative bg-light overflow-hidden">
                                    <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                                    <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                                </div>
                                <div class="text-center p-4">
                                    <a class="d-block h5 mb-2" href="">Fresh Tomato</a>
                                    <span class="text-primary me-1">$19.00</span>
                                    <span class="text-body text-decoration-line-through">$29.00</span>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="w-50 text-center border-end py-2">
                                        <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>Ver detalles</a>
                                    </small>
                                    <small class="w-50 text-center py-2">
                                        <a class="text-body" href=""><i class="fa fa-shopping-bag text-primary me-2"></i>Añadir a Carrito</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="/productos">Mas Productos</a>
                        </div>
                    </div>
                </div>
                <div id="tab-2" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-item">
                                <div class="position-relative bg-light overflow-hidden">
                                    <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                                    <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                                </div>
                                <div class="text-center p-4">
                                    <a class="d-block h5 mb-2" href="">Fresh Tomato</a>
                                    <span class="text-primary me-1">$19.00</span>
                                    <span class="text-body text-decoration-line-through">$29.00</span>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="w-50 text-center border-end py-2">
                                        <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>Ver Detalles</a>
                                    </small>
                                    <small class="w-50 text-center py-2">
                                        <a class="text-body" href=""><i class="fa fa-shopping-bag text-primary me-2"></i>Añadir a Carrito</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="/productos">Mas Productos</a>
                        </div>
                    </div>
                </div>
                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="product-item">
                                <div class="position-relative bg-light overflow-hidden">
                                    <img class="img-fluid w-100" src="img/product-1.jpg" alt="">
                                    <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">New</div>
                                </div>
                                <div class="text-center p-4">
                                    <a class="d-block h5 mb-2" href="">Fresh Tomato</a>
                                    <span class="text-primary me-1">$19.00</span>
                                    <span class="text-body text-decoration-line-through">$29.00</span>
                                </div>
                                <div class="d-flex border-top">
                                    <small class="w-50 text-center border-end py-2">
                                        <a class="text-body" href=""><i class="fa fa-eye text-primary me-2"></i>Ver detalles</a>
                                    </small>
                                    <small class="w-50 text-center py-2">
                                        <a class="text-body" href=""><i class="fa fa-shopping-bag text-primary me-2"></i>Añadir a Carritot</a>
                                    </small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <a class="btn btn-primary rounded-pill py-3 px-5" href="/productos">Mas Productos</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Product End -->



<!-- Blog Start -->
                <div class="container-xxl py-5">
                    <div class="container">
                        <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                            <h1 class="display-5 mb-3">Ultimos Blog</h1>
                            <p>Compartimos informacion acerca de tu mascota, para que puedas darle el cuidado que se merece!.</p>
                        </div>
                        <div class="row g-4">
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                                <img class="img-fluid" src="web/img/cobayo56.jpg" alt="">
                                <div class="bg-light p-4">
                                    <h3>¿Que comen los cobayos?</h3>
                                    <a class="d-block h5 lh-base mb-4" href="/blog">Claves para su correcta alimentacion</a>
                                    <div class="text-muted border-top pt-4">
                                        <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                                        <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                                <img class="img-fluid" src="web/img/perro-9.jpg" alt="">
                                <div class="bg-light p-4">
                                    <h3>Plan Vacunatorio</h3>
                                    <a class="d-block h5 lh-base mb-4" href="/blog">Todo lo que tienes que saber sobre el bienestar de tus mascotas.</a>
                                    <div class="text-muted border-top pt-4">
                                        <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                                        <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <img class="img-fluid" src="web/img/loro2.jpg" alt="">
                                <div class="bg-light p-4">
                                    <h3>Tips para cuidar a tu loro</h3>
                                    <a class="d-block h5 lh-base mb-4" href="/blog">Bienestar en aves silvestres como mascotas</a>
                                    <div class="text-muted border-top pt-4">
                                        <small class="me-3"><i class="fa fa-user text-primary me-2"></i>Admin</small>
                                        <small class="me-3"><i class="fa fa-calendar text-primary me-2"></i>01 Jan, 2045</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Blog End -->

@endsection