<?php
// print_r($_GET);
// print_r($_POST);
include(__DIR__.'/clientes.class.php');
$app = new Cliente();
include('views/header.php');
$app -> checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_cliente = (isset($_GET['id_cliente'])) ? $_GET['id_cliente'] : null;
$datos = array();
$alerta= array();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_cliente);
        if ($fila) {
            $alerta['tipo']="warning";
            $alerta['mensaje']="el cliente eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar el cliente";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/clientes/index.php');
        break;
    case 'create':        
        include('views/clientes/form.php');
        break;
    case 'save':
        $datos = $_POST;
        echo "<pre>";
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="El Cliente se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar el cliente";
        }
        $datos = $app->getAll();
        include('alert.php');
        include('views/clientes/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_cliente);
        if (isset($datos["id_cliente"])) {
            include('views/clientes/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe el cliente especificado.";
            $datos = $app->getAll();
            include('alert.php');
            include('views/clientes/index.php');
        }       
        
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_cliente,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="El Cliente se actualizó correctamente";
        }else {
            $alerta['tipo']="warning";
            $alerta['mensaje']="No se pudo actualizar el cliente";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/clientes/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/clientes/index.php');
}

include('views/footer.php');
