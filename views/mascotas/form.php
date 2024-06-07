<div class="container py-3 mt-4">
    <h1><?php echo (isset($datos['id_mascota'])) ? 'Editar' : 'Nueva'; ?> Mascota</h1>
    <form action="mascotas.php?action=<?php echo (isset($datos['id_mascota'])) ? 'change&id_mascota='.$datos['id_mascota'] : 'save'; ?>" method="post">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo (isset($datos['nombre'])) ? $datos['nombre'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza" required value="<?php echo (isset($datos['raza'])) ? $datos['raza'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" class="form-control" id="edad" name="edad" required value="<?php echo (isset($datos['edad'])) ? $datos['edad'] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="estado_mascota" class="form-label">Estado de Mascota</label>
            <input type="text" class="form-control" id="estado_mascota" name="estado_mascota" required value="<?php echo (isset($datos['estado_mascota'])) ? $datos['estado_mascota'] : ''; ?>">
        </div>
        <input type="hidden" id="id_cliente" name="id_cliente" value="<?php echo $id_ciente; ?>">
        <input type="submit" class="btn btn-primary" value="Guardar">
    </form>
</div>
