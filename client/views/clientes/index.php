<h1>Clientes</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">Regresar</button>
    <a href="clientes.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre Comleto</th>
                <th scope="col">RFC</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato) : ?>
        <tr>
            <th scope="row"><?php echo $dato['id_cliente']; ?></th>
            <td><?php echo $dato['nombre'].' '.$dato['apellido_paterno'].' '.$dato['apellido_materno']  ; ?></td>
            <td><?php echo $dato['rfc']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="clientes.php?action=update&id_cliente=<?php echo $dato['id_cliente']; ?>" class="btn btn-info">Actualizar</a>
                    <a href="clientes.php?action=delete&id_cliente=<?php echo $dato['id_cliente']; ?>" class="btn btn-danger">Borrar</a>
                </div>
            </td>
        </tr>
            <?php endforeach; ?>
    </tbody>
    </table>
    <h4>Se encontraron <?php echo $app->getCount(); ?> clientes</h4>
</div>