<div class="container py-3 mt-4">
    <h1>Mascotas</h1>
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="/index.php" class="btn btn-primary">Regresar</a>
        <a href="mascotas.php?action=create" class="btn btn-success">Nuevo</a>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Raza</th>
                    <th scope="col">Edad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($datos as $dato) : ?>
                    <tr>
                        <th scope="row"><?php echo $dato['id_mascota']; ?></th>
                        <td><?php echo $dato['nombre']; ?></td>
                        <td><?php echo $dato['raza']; ?></td>
                        <td><?php echo $dato['edad']; ?></td>
                        <td><?php echo $dato['estado_mascota']; ?></td>
                        <td><?php echo $dato['id_cliente']; ?></td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="mascotas.php?action=update&id_mascota=<?php echo $dato['id_mascota']; ?>" class="btn btn-info">Actualizar</a>
                                <a href="mascotas.php?action=delete&id_mascota=<?php echo $dato['id_mascota']; ?>" class="btn btn-danger">Borrar</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h4>Se encontraron <?php echo $app->getCount(); ?> mascotas</h4>
    </div>
</div>
