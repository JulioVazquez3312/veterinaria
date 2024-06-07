<?php
include __DIR__.'/sistema.class.php';
include __DIR__.'/views/headerSinMenu.php';
$app = new Sistema();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'correo' => $_POST['correo'],
        'password' => $_POST['password'],
        'primer_apellido' => $_POST['primer_apellido'],
        'segundo_apellido' => $_POST['segundo_apellido'],
        'nombre' => $_POST['nombre'],
        'rfc' => $_POST['rfc']
    ];
    
    $registro = $app->registrar($datos);
    
    if ($registro) {
        //include __DIR__.'/login.php';
        //header('Location: login.php');
        exit();
    } else {
        $type = 'danger';
        $message = 'Error al registrar el usuario.';
        $app->alert($type, $message);        
    }
}
?>