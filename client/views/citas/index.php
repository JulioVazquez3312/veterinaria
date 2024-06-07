<div class="container py-3 mt-4">
    <h1>Citas</h1>
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/index.php"  class="btn btn-primary">Regresar</a>
        <a href="citas.php?action=create" class="btn btn-success">Nuevo</a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre del cliente</th>                
                    <th scope="col">fecha cita</th>
                    <th scope="col">estado de la cita</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $dato) : ?>
                    <tr>
            <th scope="row"><?php echo $dato['id_cita']; ?></th>
            <td><?php echo $dato['nombre_cliente']; ?></td>
            <td><?php echo $dato['fecha_cita']; ?></td>
            <td><?php echo $dato['estado_cita']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="citas.php?action=update&id_cita=<?php echo $dato['id_cita']; ?>" class="btn btn-info">Actualizar</a>
                    <a href="citas.php?action=delete&id_cita=<?php echo $dato['id_cita']; ?>" class="btn btn-danger">Borrar</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h4 class="table-light">Se encontraron <?php echo $app->getCount(); ?> citas</h4>
</div>
</div>