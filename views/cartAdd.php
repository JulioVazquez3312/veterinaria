<?php
session_start();
include(__DIR__ . '/../client/productos.class.php');

$id_producto = isset($_GET['id_producto']) ? $_GET['id_producto'] : die("No producto");
$cantidad = isset($_GET['cantidad']) ? (int)$_GET['cantidad'] : die("No cantidad");

// Inicializa el carrito si no está inicializado
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Obtiene los detalles del producto de la base de datos
$web = new Producto();
$producto = $web->getOne($id_producto);

// Verifica si el producto existe en la base de datos
if ($producto) {
    $nombre_producto = $producto['producto'];
    $precio_producto = $producto['precio'];

    // Verifica si el producto ya está en el carrito y suma la cantidad
    if (isset($_SESSION['cart'][$id_producto])) {
        $_SESSION['cart'][$id_producto]['cantidad'] += $cantidad;
    } else {
        $_SESSION['cart'][$id_producto] = array(
            'cantidad' => $cantidad,
            'nombre' => $nombre_producto,
            'precio' => $precio_producto
        );
    }
} else {
    die("Producto no encontrado");
}

// Redirige al carrito de compras
header("Location: cart.php");
exit();
?>
