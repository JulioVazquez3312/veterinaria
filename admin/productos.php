<?php
// print_r($_GET);
// print_r($_POST);
include(__DIR__.'/productos.class.php');
include(__DIR__.'/marcas.class.php');
$app = new producto();
$appMarcas = new Marca();
include('views/header.php');
$app -> checkRol('Administrador', false);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_producto = (isset($_GET['id_producto'])) ? $_GET['id_producto'] : null;
$datos = array();
$alerta= array();
$marcas = $appMarcas->getAll();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_producto);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="Producto eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar el producto";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/productos/index.php');
        break;
    case 'create':        
        include('views/productos/form.php');
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
        include('views/productos/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_producto);
        if (isset($datos["id_producto"])) {
            include('views/productos/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe el producto especificado.";
            $datos = $app->getAll();
            include('views/alert.php');
            include('views/productos/index.php');
        }       
        
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_producto,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="el producto se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar el producto";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/productos/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/productos/index.php');
}
include('views/footer.php');
