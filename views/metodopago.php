<?php
// session_start(); // Asegúrate de tener la sesión iniciada
require_once(__DIR__ . '/../client/sistema.class.php'); // Ajusta la ruta según tu estructura de archivos

$app = new Sistema();

if ($app->checkRol("Administrador", false)){
    include(__DIR__.'/../client/views/header.php');
}else{
    include(__DIR__.'/header.php');
}
$app->connect();

// Obtener métodos de pago desde la base de datos
$stmt = $app->conn->prepare("SELECT * FROM metodo_pago");
$stmt->execute();
$metodos_pago = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container center mt-4 p-4 bg-primary-subtle">
    <h2>Selecciona tu método de pago:</h2>  

        <form action="pago.php" method="post">
            <?php foreach ($metodos_pago as $metodo): ?>
                <div class="form-check">
                    <label class="form-check-label"><?php echo strtoupper($metodo['metodo_pago'] );?></label>
                    <input class="form-check-input" type="radio" name="metodo_pago" value="<?= $metodo['id_metodo_pago'] ?>" required>
                </div>
                <?php endforeach; ?>
                <button class="btn btn-success" type="submit">Pagar</button>
            </form>
</div>      