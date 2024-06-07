<?php
include(__DIR__ . '/perfil.class.php');
include(__DIR__.'/../views/header.php');

$app = new Perfil();
$app->checkRol("Cliente", true);

$id_venta = $_GET['id_venta'];

// Obtener los detalles del pedido
$datos = $app->getOne($id_venta);

include('views/perfil/detalle_pedido.php');
?>
