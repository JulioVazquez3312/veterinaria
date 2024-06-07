<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Veterinaria</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="/css/bootstrap.min-2.css" rel="stylesheet" />
</head>

<body>
    <!-- Responsive navbar-->
    <nav data-bs-theme="dark" class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container px-5">
            <a class="navbar-brand" href="/index.php">Veterinaria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link" aria-current="page" href="/index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="/client/citas.php">Citas</a></li>
                    <li class="nav-item"><a class="nav-link" href="/client/productos.php">Productos</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Servicios</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/client/citas.php">Citas</a></li>
                            <li><a class="dropdown-item" href="/client/productos.php">Productos</a></li>
                            <li><a class="dropdown-item" href="/client/clientes.php">Clientes</a></li>
                            <li><a class="dropdown-item" href="/client/marcas.php">Marcas</a></li>
                            <li><a class="dropdown-item" href="/client/mascotas.php">Registrar mascota</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            <li><a class="dropdown-item" href="/admin/index.php">Adminstrador</a></li>
                    </li>
                </ul>
                <?php if (isset($_SESSION['validado']) ?? $_SESSION['validado'] == TRUE) { ?>
                    <li class="nav-item"><a class="nav-link" href="/client/login.php?action=logout">Logout</a></li>
                <?php } else { ?>
                    <li class="nav-item"><a class="nav-link" href="/client/login.php">Login</a></li>
                <?php } ?>

                </li>
                </ul>
            </div>
        </div>
    </nav>