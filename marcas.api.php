<?php
header('Content-Type: application/json; charset=utf-8');
$action = (isset($_SERVER['REQUEST_METHOD'])) ? $_SERVER['REQUEST_METHOD'] : null;
include (__DIR__ . '/client/marcas.class.php');
$marcas = new Marca();
$conn = $marcas->connect();
switch ($action) {
    case "GET":
    default:
        $stmt = $marcas->getAll();
        $datos =json_encode($stmt);
        print_r($datos);
        break;
}
?>