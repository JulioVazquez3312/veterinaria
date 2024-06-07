<?php
include __DIR__.'/sistema.class.php';
$app = new Sistema();
require_once ('views/headerSinMenu.php');
$action = (isset($_GET['action'])) ? $_GET['action'] : null;
switch ($action) {
    case 'singup':
        include __DIR__.'/views/login/singup.php';
        break;
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
            $type = 'success';
            $message = 'Se ha iniciado sesión correctamente';
            $app->alert($type, $message);
            header('location:/index.php');
        }else{
            $type = 'danger';
            $message = 'Usuario o contraseña incorrectos';
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
            $message = 'Correo no encontrado';
            $app->alert($type, $message);
        }
    break;
    case 'recovery':
        if (isset($_GET['token'])) {
            $token = $_GET['token'];
            if ($app->recovery($token)) {
                if (isset($_POST['password'])) {
                    $password = $_POST['password'];
                    if ($app->recovery($token, $password)) {
                        $type = "success";
                        $message = 'Contraseña actualizada correctamente';
                        $app->alert($type, $message);
                        include __DIR__ . '/views/login/index.php';
                        die();
                    } else {
                        $type = "danger";
                        $message = 'No se pudo actualizar la contraseña';
                        $app->alert($type, $message);
                        die();
                    }
                }
                include __DIR__ . '/views/login/recovery.php';
                die();
            }
            $app->alert('danger', ' Token no valido');
            include 'views/login/index.php';
        }
        break;
    default:
        include __DIR__.'/views/login/index.php';
    }
?>
