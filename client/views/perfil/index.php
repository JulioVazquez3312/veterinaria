<div class="container py-3 mt-4">
    <h1>Hola <?php echo $nombre_cliente;?></h1>
    <p>Estas son tus pedidos</p>
    <?php if (!empty($pedidos)): ?>
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID Venta</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cantidad de Productos</th>
                <th scope="col">Total Precio</th>
                <th scope="col">Detalles</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?php echo htmlspecialchars($pedido['id_venta']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['cantidad_producto']); ?></td>
                    <td>$<?php echo htmlspecialchars($pedido['total_precio']); ?></td>
                    <td>
                        <a href="detalle_pedido.php?id_venta=<?php echo $pedido['id_venta']; ?>" class="btn btn-info btn-sm">Ver Detalles</a>
                    </td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No tienes pedidos.</p>
        <?php endif; ?>
</div>