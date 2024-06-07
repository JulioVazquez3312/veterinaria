<?php
// print_r($_GET);
// print_r($_POST);
include(__DIR__.'/empleados.class.php');
$app = new Empleado();
include('views/header.php');
$app->checkRol('Administrador', true);
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_empleado = (isset($_GET['id_empleado'])) ? $_GET['id_empleado'] : null;
$datos = array();
$alerta= array();
switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_empleado);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="Empleado eliminado correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar la Empleado";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/empleado/index.php');
        break;
    case 'create':
        
        include('views/empleado/form.php');
        break;
    case 'save':
        $datos = $_POST;
        $datos["fotografia"] = $_FILES['fotografia']['name'];
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La Empleado se registro correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar la Empleado";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/empleado/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_empleado);
        if (isset($datos["id_empleado"])) {
            include('views/empleado/form.php');
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe la Empleado especificado.";
            $datos = $app->getAll();
            include('views/alert.php');
            include('views/empleado/index.php');
        }       
        
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_empleado,$datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La Empleado se actualizó correctamente";
        }else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar la Empleado";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/empleado/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/empleado/index.php');
}
include('views/footer.php');
