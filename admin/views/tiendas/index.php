<h1>Tiendas</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="tiendas.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Tienda</th>
                <th scope="col">Fotografia</th>
                <th scope="col">Latitud</th>
                <th scope="col">Longitud</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato) : ?>
        <tr>
            <th scope="row"><?php echo $dato['id_tienda']; ?></th>
            <td><?php echo $dato['tienda']; ?></td>
            <td><?php echo $dato['latitud']; ?></td>
            <td><?php echo $dato['longitud']; ?></td>
            <td>
                <img src="/uploads/tiendas/default.jpg" />    
            <?php echo $dato['fotografia']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="tiendas.php?action=update&id_tienda=<?php echo $dato['id_tienda']; ?>" class="btn btn-info">Actualizar</a>
                    <a href="tiendas.php?action=delete&id_tienda=<?php echo $dato['id_tienda']; ?>" class="btn btn-danger">Borrar</a>
                </div>
            </td>
        </tr>
            <?php endforeach; ?>
    </tbody>
    </table>
    <h4>Se encontraron <?php echo $app->getCount(); ?> tiendas</h4>
</div>