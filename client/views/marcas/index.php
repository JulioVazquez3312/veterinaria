<div class="container py-3 mt-4">
    <h1>Marcas</h1>
    <div class="btn-group" role="group" aria-label="Basic example">
    <a href="/index.php"  class="btn btn-primary">Regresar</a>
    <a href="marcas.php?action=create" class="btn btn-success">Nuevo</a>
</div>
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Marca</th>
                <th scope="col">Fotografia</th>
                <th scope="col">Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $dato) : ?>
        <tr>
            <th scope="row"><?php echo $dato['id_marca']; ?></th>
            <td><?php echo $dato['marca']; ?></td>
            <td><?php echo $dato['fotografia']; ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="marcas.php?action=update&id_marca=<?php echo $dato['id_marca']; ?>" class="btn btn-info">Actualizar</a>
                    <a href="marcas.php?action=delete&id_marca=<?php echo $dato['id_marca']; ?>" class="btn btn-danger">Borrar</a>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<h4 class="table-light">Se encontraron <?php echo $app->getCount(); ?> marcas</h4>
</div>
</div>