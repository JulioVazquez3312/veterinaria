<div class="container py-3 mt-4">
    <h1>Estos son las ordenes de compra</h1>
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="index.php" type="button" class="btn btn-primary">Regresar</a>
        <a href="archivo.php?action=create" target="_blank" class="btn btn-success">Generar exel</a>
    </div>

    <?php if (!empty($pedidos)): ?>
        <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID Venta</th>
                <th scope="col">Fecha</th>
                <th scope="col">Cantidad de Productos</th>
                <th scope="col">Total Precio</th>                
            </tr>
        </thead>
        <tbody>
            <?php foreach ($pedidos as $pedido): ?>
                <tr>
                    <td><?php echo htmlspecialchars($pedido['id_venta']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['fecha']); ?></td>
                    <td><?php echo htmlspecialchars($pedido['cantidad_producto']); ?></td>
                    <td>$<?php echo htmlspecialchars($pedido['total_precio']); ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No tienes pedidos.</p>
        <?php endif; ?>
</div>