<div class="container">
    <form action="empleados.php?action=<?php echo($action=='update')?'change&id_empleado='.$datos['id_empleado']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nuevo'; ?> Empleado</h2>
        <div class="mb-3">
            <label for="InputPrimerApellido" class="form-label">Primer Apellido</label>
            <input type="text" class="form-control" id="InputPrimerApellido" name="apellido_paterno" required="required" value="<?php echo (isset($datos["primer_apellido"])) ? $datos["primer_apellido"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputSegundoApellido" class="form-label">Segundo Apellido</label>
            <input type="text" class="form-control" id="InputSegundoApellido" name="apellido_materno" value="<?php echo (isset($datos["segundo_apellido"])) ? $datos["segundo_apellido"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputNombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="InputNombre" name="nombre" required="required" value="<?php echo (isset($datos["nombre"])) ? $datos["nombre"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputRFC" class="form-label">RFC</label>
            <input type="text" class="form-control" pattern="[A-Z](4)[0-9](6)[A-Z0-9](3)(" id="InputRFC" name="rfc" required="required" value="<?php echo (isset($datos["rfc"])) ? $datos["rfc"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="InputCURP" class="form-label">CURP</label>
            <input type="text" class="form-control" id="InputCURP" name="curp" required="required" value="<?php echo (isset($datos["curp"])) ? $datos["curp"] : ''; ?>">
        </div>
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>
