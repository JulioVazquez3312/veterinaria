<?php
// print_r($_GET);
// print_r($_POST);
include('tiendas.class.php');

$app = new tienda();
//$app = new Marca();
include('views/header.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_tienda = (isset($_GET['id_tienda'])) ? $_GET['id_tienda'] : null;
$datos = array();
$alerta= array();
$marcas = $app->getAll();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_tienda);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="Producto eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar el producto";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/tiendas/index.php');
        break;
    case 'create':        
        include('views/tiendas/form.php');
        break;
    case 'save':
        $datos = $_POST;
        echo "<pre>";
        /* print_r($_POST);
        print_r($_GET);
        print_r($_FILES); */
        // die;
        $datos["fotografia"] = $_FILES['fotografia']['name'];
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="el producto se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar el producto";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/tiendas/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_tienda);
        if (isset($datos["id_tienda"])) {
            include('views/tiendas/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe el producto especificado.";
            $datos = $app->getAll();
            include('views/alert.php');
            include('views/tiendas/index.php');
        }        
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_tienda,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="el producto se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar el producto";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/tiendas/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/tiendas/index.php');
}
include('views/footer.php');
