<h1>Productos</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="productos.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Marca</th>
                <th scope="col">Precio</th>
                <th scope="col">Marca</th>
                <th scope="col">Fotografia</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato) : ?>
        <tr>
            <th scope="row"><?php echo $dato['id_producto']; ?></th>
            <td><?php echo $dato['producto']; ?></td>
            <td>$ <?php echo $dato['precio']; ?></td>
            <td><?php echo $dato['marca']; ?></td>
            <td><?php echo $dato['fotografia']; ?></td>
            <td>
                <div class="container btn-group" role="group" aria-label="Basic example">
                    <a href="productos.php?action=update&id_producto=<?php echo $dato['id_producto']; ?>" class="btn btn-info">Actualizar</a>
                    <a href="productos.php?action=delete&id_producto=<?php echo $dato['id_producto']; ?>" class="btn btn-danger">Borrar</a>
                </div>
            </td>
        </tr>
            <?php endforeach; ?>
    </tbody>
    </table>
    <h4>Se encontraron <?php echo $app->getCount(); ?> productos</h4>
</div>