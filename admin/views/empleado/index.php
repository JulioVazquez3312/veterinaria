<div class="container py-3 mt-4">
<h1>Empleados</h1>
<div class="btn-group" role="group" aria-label="Basic example">
    <a href="index.php" type="button" class="btn btn-primary">Regresar</a>
    <a href="empleados.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido Paterno</th>
                <th scope="col">Apellido Materno</th>
                <th scope="col">RFC</th>
                <th scope="col">CURP</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato) : ?>
        <tr>
            <th scope="row"><?php echo $dato['id_empleado']; ?></th>
            <td><?php echo $dato['nombre']; ?></td>
            <td><?php echo $dato['apellido_paterno']; ?></td>
            <td><?php echo $dato['apellido_materno']; ?></td>
            <td><?php echo $dato['rfc']; ?></td>
            <td><?php echo $dato['curp']; ?></td>
            
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="empleados.php?action=update&id_empleado=<?php echo $dato['id_empleado']; ?>" class="btn btn-info">Actualizar</a>
                    <a href="empleados.php?action=delete&id_empleado=<?php echo $dato['id_empleado']; ?>" class="btn btn-danger">Borrar</a>
                </div>
            </td>
        </tr>
            <?php endforeach; ?>
    </tbody>
    </table>
    <P>Se encontraron <?php echo $app->getCount(); ?> marcas</P>
</div>
</div>