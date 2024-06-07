<?php
session_start(); // Iniciar sesión
echo '<pre>';
print_r($_SESSION);
//die;
if (isset($_SESSION['correo'])) {
    header('Location: /views/metodopago.php'); // Redirige a la página de pago si está autenticado
    exit();
}else{
    header("Location: /client/login.php");
    exit();
}

?>
