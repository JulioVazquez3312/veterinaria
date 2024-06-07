<?php
include(__DIR__.'/reportes.class.php');
$app = new Reportes();
include('views/header.php');
//$app -> checkRol('Administrador', false);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_venta = (isset($_GET['id_venta'])) ? $_GET['id_venta'] : null;
$datos = array();
$alerta= array();
switch ($action) {
    case 'reportes':
        $app->productos();
        break;
    case 'ventas':     
        $app->orders($id_venta);
        break;
    default:        
        include('views/productos/index.php');
}
include('views/footer.php');

?>