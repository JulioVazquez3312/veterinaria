<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Veterinaria</title>
    <link href="/css/bootstrap.min-2.css" rel="stylesheet" />
  </head>
  <body>
  <nav data-bs-theme="dark" class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Veterinaria</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="empleados.php">Empleado</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="orders.php">Ordenes</a>
        </li>
        <li class="nav-item">          
          <a class="nav-link " aria-current="page" href="login.php?action=logout">Logout</a>
        </li>    
        <li class="nav-item">          
          <a class="nav-link " aria-current="page" href="../index.php">Inicio Cliente</a>
        </li>    
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>