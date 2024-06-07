<?php
include('views/header.php');
include(__DIR__.'/orders.class.php');
$app = new Order();
$app->checkRol('Administrador', true);

$pedidos = $app->getAll();

include('views/orders/index.php');
?>