<?php
//session_start();
require_once(__DIR__ . '/../client/sistema.class.php'); // Ajusta la ruta según tu estructura de archivos
$sistema = new Sistema(); 
$id_cliente = $_SESSION['id_usuario'];  // Asumimos que el ID del usuario está almacenado en la sesión
$id_empleado = 1; // Suponiendo que obtienes esto de la sesión del empleado o de otro lugar
$id_metodo_pago = (int)$_POST['metodo_pago'];

// Verificar que el método de pago ha sido seleccionado
if (!isset($_POST['metodo_pago'])) {
    die('Error: Debe seleccionar un método de pago.');
}

try {
    $sistema->connect();
    $sistema->conn->beginTransaction(); // Iniciar una transacción

    // Insertar en la tabla 'venta'
    $stmt = $sistema->conn->prepare("INSERT INTO venta (id_cliente, id_empleado, fecha) VALUES (:id_cliente, :id_empleado, NOW())");
    $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt->bindParam(':id_empleado', $id_empleado, PDO::PARAM_INT);
    $stmt->execute();
    $id_venta = $sistema->conn->lastInsertId(); // Obtener el ID de la venta recién insertada

    // Insertar en la tabla 'venta_detalle' por cada producto en el carrito
    foreach ($_SESSION['cart'] as $id_producto => $producto) {
        $stmt = $sistema->conn->prepare("INSERT INTO venta_detalle (id_venta, id_producto, cantidad, id_metodo_pago) VALUES (:id_venta, :id_producto, :cantidad, :id_metodo_pago)");
        $stmt->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->bindParam(':cantidad', $producto['cantidad'], PDO::PARAM_INT);
        $stmt->bindParam(':id_metodo_pago', $id_metodo_pago, PDO::PARAM_INT);
        $stmt->execute();
    }

    $sistema->conn->commit(); // Confirmar la transacción
    unset($_SESSION['cart']);
    // Redirigir a una página de confirmación
    header("Location: confirmacion.php");
    exit();

} catch (Exception $e) {
    $sistema->conn->rollBack(); // Revertir la transacción en caso de error
    echo "Error al procesar la compra: " . $e->getMessage();
}


?>
