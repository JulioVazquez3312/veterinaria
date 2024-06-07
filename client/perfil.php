<?php
include(__DIR__ . '/perfil.class.php');
include(__DIR__.'/../views/header.php');
$app = new Perfil();
$app->connect();
$app->checkRol("Cliente", true);

$id_usuario = $_SESSION['id_usuario'];
$nombre_cliente = $app->getNombre($id_usuario);
//die;
$pedidos = $app->getAll($id_usuario);

include('views/perfil/index.php');

?>

