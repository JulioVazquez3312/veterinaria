<?php
include(__DIR__.'/client/sistema.class.php');
include(__DIR__.'/client/marcas.class.php');
$app = new Sistema();
$marcas = new Marca();
if ($app->checkRol("Administrador", false)){
    include(__DIR__.'/client/views/header.php');
}else{
    include(__DIR__.'/views/header.php');
}
?>

<style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background: linear-gradient(90deg, #66BB6A, #43A047);
            color: white;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        header p {
            margin: 5px 0 0;
            font-size: 1.2em;
        }
        section {
            padding: 20px;
            margin: 20px 0;
        }
        .images img {
            width: 100%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .services, .testimonials, .contact {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .services ul {
            list-style: none;
            padding: 0;
        }
        .services ul li {
            background: url('icon.png') no-repeat left center;
            background-size: 20px;
            padding-left: 30px;
            margin: 10px 0;
            font-size: 1.1em;
        }
        .about {
            text-align: center;
        }
        .testimonials blockquote {
            border-left: 5px solid #66BB6A;
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #f9f9f9;
            border-radius: 5px;
        }
        .cta {
            background: linear-gradient(90deg, #FF7043, #FF5722);
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .cta a {
            background-color: #fff;
            color: #FF7043;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .cta a:hover {
            background-color: #FF5722;
            color: white;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }
        footer a {
            color: white;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s;
        }
        footer a:hover {
            color: #FF5722;
        }
    </style>
</head>
<body>
    <header>
        <h1>¡Bienvenidos a la Veterinaria!</h1>
        <p>Cuidamos de tu mascota como si fuera nuestra.</p>
    </header>

    <section class="images">
        <img src="/assets/img/kwk_es_acceso_accesorios.webp" alt="Mascotas banner">
    </section>

    <div class="container px-4 px-lg-5">
        <!-- Heading Row-->
        <div class="row gx-4 gx-lg-5 align-items-center my-5">
            <div class="col-lg-7">
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="assets/img/imagen2.jpg">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/imagen3.jpg">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="assets/img/imagen4.jpg">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>
            <div class="col-lg-5">
                <h1 class="font-weight-light">Veterinaria</h1>
                <p> Resistate en nuestro sitio web para crear una cuenta en nuestro sitio.
                    Para poder agendar citas y comprar nuestros productos
                </p>
                <a class="btn btn-success" href="/client/login.php?action=singup">Registrarse</a>
            </div>
        </div>


    <section class="container services">
        <div class="">
            <h2>Nuestros Servicios</h2>
            <ul>
                <li>Consultas Médicas</li>
                <li>Vacunación</li>
                <li>Cirugías</li>
                <li>Cuidado Dental</li>
                <li>Urgencias 24/7</li>
                <li>Peluquería y Baño</li>
            </ul>
        </div>
                <!-- Call to Action-->
                <div class="card text-white bg-warning my-5 py-4 text-center">
            <div class="card-body">
                <h4 class="text m-1">Estos son los servicios que ofrecemos</h4>
                <a class="btn btn-info text-white" href="#">Quiero saber mas de los servicios</a>
            </div>
        </div>
        <!-- Content Row-->
        <div class="row gx-4 gx-lg-5">
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">Citas</h2>
                        <p class="card-text">Agenda una cita para tu mascota</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="/client/citas.php">Ver citas</a></div>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">Productos</h2>
                        <p class="card-text">hecha un vistaso a nuestros productos</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="/views/productos.php">Ir a los productos</a></div>
                </div>
            </div>
            <div class="col-md-4 mb-5">
                <div class="card h-100">
                    <div class="card-body">
                        <h2 class="card-title">Registrar mascota</h2>
                        <p class="card-text">Registra tu mascota</p>
                    </div>
                    <div class="card-footer"><a class="btn btn-primary btn-sm" href="/views/mascotas.php">Ir a mascotas</a></div>
                </div>
            </div>
        </div>
    </div>
    </section>

    <section class="about">
        <h2>Sobre Nosotros</h2>
        <p> nuestro equipo está compuesto por veterinarios altamente calificados y amantes de los animales. Nos dedicamos a proporcionar el mejor cuidado para tu mascota, asegurando su salud y bienestar.</p>
    </section>

    <section class="container testimonials">
        <h2>Lo que dicen nuestros clientes</h2>
        <blockquote>
            <p>"Gracias, mi perro está más saludable y feliz que nunca." - Juan P.</p>
        </blockquote>
        <blockquote>
            <p>"El personal es muy amable y profesional. Recomiendo sus servicios al 100%." - María G.</p>
        </blockquote>
    </section>

    <section class="contact">
        <h2>Ubicación y Contacto</h2>
        <p>Dirección:</p>
        <p>Teléfono:</p>
        <p>Correo Electrónico: </p>
        <p>Horario de Atención:</p>
        <p>Lunes a Viernes: 9 AM - 7 PM</p>
        <p>Sábado: 9 AM - 2 PM</p>
        <p>Domingo: Urgencias</p>
    </section>

    <section class="cta">
        <h2>¡Agenda una cita hoy!</h2>
        <a href="#" class="button">Reservar Ahora</a>
    </section>

<!-- Page Content-->




    <div class="container py-3 mt-4">
        <h1 class="center">Las marcas disponibles</h1>
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php 
                $datos = $marcas->getAll();  
                foreach ($datos as $dato) : ?>
                <div class="col mb-5">
                <div class="card h-100">
                    <img src="uploads/marcas/<?php echo $dato['fotografia']; ?>"
                                alt="<?php echo $dato['marca']; ?>" class="card-img-top img-fluid">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $dato['marca']; ?></h5>
                            <p class="card-text"><a href="" class="card-link">Ver detalles</a></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
    </div>
        </div>
    </div>

<?php
include('client/views/footer.php');
?>