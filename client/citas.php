<?php
// print_r($_GET);
// print_r($_POST);
include(__DIR__.'/citas.class.php');
include(__DIR__.'/estado.citas.php');
$app = new citas();
$appMarcas = new EstadoCitas();
$clientes = $app->getClientes();
include('views/header.php');
$app -> checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_cita = (isset($_GET['id_cita'])) ? $_GET['id_cita'] : null;
$datos = array();
$alerta= array();
$marcas = $appMarcas->getAll();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_cita);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="cita se a eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar la cita";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/citas/index.php');
        break;
    case 'create':        
        include('views/citas/form.php');
        break;
    case 'save':
        $datos = $_POST;
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La cita se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar la cita";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/citas/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_cita);
        if (isset($datos["id_cita"])) {
            include('views/citas/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe la cita especificada.";
            $datos = $app->getAll();
            include('views/alert.php');
            include('views/citas/index.php');
        }       
        
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_cita,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="el cita se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar el cita";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/citas/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/citas/index.php');
}
include('views/footer.php');
