<div class="container py-3 mt-4">
    <h1>Detalles del Pedido</h1>
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="perfil.php" class="btn btn-info">Volver al perfil</a>
        <?php if (!empty($datos)): ?>
            <a href="reportes.php?action=ventas&id_venta=<?php echo htmlspecialchars($datos[0]['id_venta']); ?>" target="_blank" class="btn btn-warning">Generar pdf</a>
        <?php else: ?>
            <p>No hay detalles disponibles para este pedido.</p>
        <?php endif; ?>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID venta</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato): ?>
                <tr>
                    <td><?php echo htmlspecialchars($dato['id_venta']); ?></td>
                    <td><?php echo htmlspecialchars($dato['producto']); ?></td>
                    <td><?php echo htmlspecialchars($dato['cantidad_producto']); ?></td>
                    <td>$<?php echo htmlspecialchars($dato['total_precio']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
