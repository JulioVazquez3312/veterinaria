<?php
// print_r($_GET);
// print_r($_POST);
include(__DIR__.'/marcas.class.php');
$app = new Marca();
include('views/header.php');
$app->checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_marca = (isset($_GET['id_marca'])) ? $_GET['id_marca'] : null;
$datos = array();
$alerta= array();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_marca);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="Marca eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar la marca";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/marcas/index.php');
        break;
    case 'create':
        
        include('views/marcas/form.php');
        break;
    case 'save':
        $datos = $_POST;
        $datos["fotografia"] = $_FILES['fotografia']['name'];
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La marca se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar la marca";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/marcas/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_marca);
        if (isset($datos["id_marca"])) {
            include('views/marcas/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe la marca especificado.";
            $datos = $app->getAll();
            include('views/alert.php');
            include('views/marcas/index.php');
        }       
        
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_marca,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La marca se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar la marca";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/marcas/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/marcas/index.php');
}

include('views/footer.php');
