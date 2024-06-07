<?php
include(__DIR__.'/../client/sistema.class.php');
$app = new Sistema();
if ($app->checkRol("Administrador", false)){
    include(__DIR__.'/../client/views/header.php');
}else{
    include(__DIR__.'/header.php');
}
?>
<div class="container">
    <h1>Tu Carrito de Compras</h1>
    <a href="productos.php" class="btn btn-info">Volver a la tienda</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Subtotal</th>                
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
                foreach($_SESSION['cart'] as $id_producto => $producto) {
                    $subtotal = $producto['cantidad'] * $producto['precio'];
                    echo "<tr>";
                    echo "<td>" . $producto['nombre'] . "</td>";
                    echo "<td>" . $producto['cantidad'] . "</td>";
                    echo "<td>$" . $producto['precio'] . "</td>";                    
                    echo "<td>$" . $subtotal . "</td>";
                    echo "</tr>";
                    $total += $subtotal;
                }
            } else {
                echo "<tr><td colspan='4'>No hay productos en el carrito</td></tr>";
            }
            ?>
            <tr>
                <td colspan="3"><strong>Total</strong></td>
                <td>$ <?php echo $total; ?></td>
            </tr>
        </tbody>
    </table>
    <!-- Botón de Pago -->
    <?php if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
        <form action="checkout.php" method="post">
            <button type="submit" class="btn btn-success">Pagar</button>
        </form>
    <?php else: ?>
        <p>No puedes pagar porque no hay productos en el carrito.</p>
    <?php endif; ?>      
</div>
<?php include (__DIR__ .'/../client/views/footer.php'); ?>
