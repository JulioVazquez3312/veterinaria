<div class="container">
    <form action="mascota.php?action=<?php echo ($action == 'update') ? 'change&id_mascota=' . $datos['id_mascota'] : 'save'; ?>" method="post">
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nueva'; ?> Mascota</h2>
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required value="<?php echo (isset($datos["nombre"])) ? $datos["nombre"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza" required value="<?php echo (isset($datos["raza"])) ? $datos["raza"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" class="form-control" id="edad" name="edad" required value="<?php echo (isset($datos["edad"])) ? $datos["edad"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="id_estado_mascota" class="form-label">Estado de Mascota</label>
            <select class="form-select" id="id_estado_mascota" name="id_estado_mascota" required>
                <option value="1" <?php echo (isset($datos["id_estado_mascota"]) && $datos["id_estado_mascota"] == 1) ? 'selected' : ''; ?>>Estado 1</option>
                <option value="2" <?php echo (isset($datos["id_estado_mascota"]) && $datos["id_estado_mascota"] == 2) ? 'selected' : ''; ?>>Estado 2</option>
                <!-- Agrega más opciones según tus necesidades -->
            </select>
        </div>
        <div class="mb-3">
            <label for="id_cliente" class="form-label">Cliente</label>
            <select class="form-select" id="id_cliente" name="id_cliente" required>
                <option value="1" <?php echo (isset($datos["id_cliente"]) && $datos["id_cliente"] == 1) ? 'selected' : ''; ?>>Cliente 1</option>
                <option value="2" <?php echo (isset($datos["id_cliente"]) && $datos["id_cliente"] == 2) ? 'selected' : ''; ?>>Cliente 2</option>
                <!-- Agrega más opciones según tus necesidades -->
            </select>
        </div>
        <input type="submit" class="btn btn-primary" value="Guardar">
    </form>
</div>
