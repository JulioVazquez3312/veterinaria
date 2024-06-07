<?php
include(__DIR__.'/mascotas.class.php');
$app = new Mascota();
//session_start(); // Inicia la sesión para usar variables de sesión

if (!isset($_SESSION['id_usuario'])) {
    header('Location: /../client/login.php'); // Redirige al login si no está autenticado
    exit();
}
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
$id_mascota = (isset($_GET['id_mascota'])) ? $_GET['id_mascota'] : null;
$datos = array();
$alerta = array();
$user_id = $_SESSION['id_usuario']; // Obtén el ID del usuario autenticado
$id_ciente = $app->getIdclient($user_id);
$cliente = $id_ciente[0]['id_cliente'];
/*
echo "<pre>"; 
print_r($id_ciente);
die;
*/
if ($app->checkRol("Cliente", true)){
    include(__DIR__.'/header.php');
}else{
    include(__DIR__.'/../views/header.php');
}

switch ($action) {
    case 'delete':
        $fila = $app->Delete($id_mascota);
        if ($fila) {
            $alerta['tipo'] = "success";
            $alerta['mensaje'] = "Mascota eliminada correctamente";
        } else {
            $alerta['tipo'] = "danger";
            $alerta['mensaje'] = "No se pudo eliminar la mascota";
        }
        $datos = $app->getAllByUser($cliente);
        include('../client/views/alert.php');
        include('mascotas/index.php');
        break;
    case 'create':
        $cliente;
        include('mascotas/form.php');
        break;
    case 'save':
        $datos = $_POST;
        $datos['id_cliente']=$cliente;
        if ($app->Insert($datos)) {
            $alerta['tipo'] = "success";
            $alerta['mensaje'] = "La mascota se registró correctamente";
        } else {
            $alerta['tipo'] = "danger";
            $alerta['mensaje'] = "No se pudo registrar la mascota";
        }
        $datos = $app->getAllByUser($cliente);
        include('../client/views/alert.php');
        include('mascotas/index.php');
        break;
    case 'update':
        $datos = $app->getOne($id_mascota);
        if (isset($datos["id_mascota"])) {
            include('mascotas/form.php');
        } else {
            $alerta['tipo'] = "danger";
            $alerta['mensaje'] = "No existe la mascota especificada.";
            $datos = $app->getAllByUser($cliente);
            include('../client/views/alert.php');
            include('mascotas/index.php');
        }
        break;
    case 'change':
        $datos = $_POST;
        $datos['id_cliente']=$cliente;
        if ($app->Update($id_mascota, $datos)) {
            $alerta['tipo'] = "success";
            $alerta['mensaje'] = "La mascota se actualizó correctamente";
        } else {
            $alerta['tipo'] = "danger";
            $alerta['mensaje'] = "No se pudo actualizar la mascota";
        }
        $datos = $app->getAllByUser($cliente);
        include('../client/views/alert.php');
        include('mascotas/index.php');
        break;
    default:
    $datos['id_cliente']=$cliente;
    $datos = $app->getAllByUser($cliente);
        include('mascotas/index.php');
}
include('../client/views/footer.php');
?>
