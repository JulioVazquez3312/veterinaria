<div class="container">
    <form action="clientes.php?action=<?php echo($action=='update')?'change&id_cliente='.$datos['id_cliente']:'save'; ?>" method="post" >
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nuevo'; ?> Cliente</h2>
        <div class="mb-3">
            <label for="Inputnombre" class="form-label">nombre</label>
            <input type="text" class="form-control" id="Inputnombre" name="nombre" required="required" value="<?php echo (isset($datos["nombre"])) ? $datos["nombre"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="Inputapellido_paterno" class="form-label">apellido_paterno</label>
            <input type="text" class="form-control" id="Inputapellido_paterno" name="apellido_paterno" required="required" value="<?php echo (isset($datos["apellido_paterno"])) ? $datos["apellido_paterno"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="Inputapellido_materno" class="form-label">apellido_materno</label>
            <input type="text" class="form-control" id="Inputapellido_materno" name="apellido_materno" required="required" value="<?php echo (isset($datos["apellido_materno"])) ? $datos["apellido_materno"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="Inputrfc" class="form-label">rfc</label>
            <input type="text" class="form-control" id="Inputrfc" name="rfc" value="<?php echo (isset($datos["rfc"])) ? $datos["rfc"] : 'XXAX000000XXX'; ?>">
        </div>

        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>