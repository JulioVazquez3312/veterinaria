<?php
include __DIR__.'\..\client\sistema.class.php';
$app = new Sistema();
require_once ('views/headerSinMenu.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
switch ($action) {
    case 'forgot':
        include __DIR__.'/views/login/forgot.php';
        break;
    case 'logout':
        $app->logout();
        $type = 'info';
        $message = 'Session cerrada correctamente';
        $app->alert($type, $message);
        break;
    case 'login':
        $correo = $_POST['correo'];
        $password = $_POST['password'];
        $login = $app->login($correo, $password);
        
        if($login){
            header('location:index.php');
            $app->alert($type, $message);
        }else{
            $type = 'danger';
            $message = 'Permiso denegado';
            $app->alert($type, $message);
        }
    break;
    case 'reset':
        $correo = $_POST['correo'];
        $login = $app->reset($correo);
        
        if($login){
            $type = 'success';
            $message = 'Se ha enviado un correo para recuperar la contraseña';
            $app->alert($type, $message);
        }else{
            $type = 'danger';
            $message = 'Permiso denegado';
            $app->alert($type, $message);
        }
    break;

    default:
        include __DIR__.'/views/login/index.php';

    }
?>
