<?php
include(__DIR__.'/mascotas.class.php');
$app = new Mascota();
//include('views/header.php');
if ($app->checkRol("Administrador", true)){
    include(__DIR__.'/views/header.php');
}else{
    include(__DIR__.'/../views/header.php');
}
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_mascota = (isset($_GET['id_mascota'])) ? $_GET['id_mascota'] : null;
$datos = array();
$alerta= array();

switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_mascota);
        if ($fila) {
            $alerta['tipo']="success";
            $alerta['mensaje']="Mascota eliminada correctamente";
        } else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo eliminar la mascota";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/mascotas/index.php');
        break;
    case 'create':
        include('views/mascotas/form.php');
        break;
    case 'save':
        $datos = $_POST;
        if ($app->Insert($datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La mascota se registró correctamente";
        } else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo registrar la mascota";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/mascotas/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_mascota);
        if (isset($datos["id_mascota"])) {
            include('views/mascotas/form.php');
        } else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No existe la mascota especificada.";
            $datos = $app->getAll();
            include('views/alert.php');
            include('views/mascotas/index.php');
        }
        break;
    case 'change':
        $datos = $_POST;
        if ($app->Update($id_mascota, $datos)) {
            $alerta['tipo']="success";
            $alerta['mensaje']="La mascota se actualizó correctamente";
        } else {
            $alerta['tipo']="danger";
            $alerta['mensaje']="No se pudo actualizar la mascota";
        }
        $datos = $app->getAll();
        include('views/alert.php');
        include('views/mascotas/index.php');
        break;
    default:
        $datos = $app->getAll();
        include('views/mascotas/index.php');
}
include('views/footer.php');
?>
