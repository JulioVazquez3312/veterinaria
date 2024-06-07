<div class="container">
    <form action="citas.php?action=<?php echo ($action == 'update') ? 'change&id_cita=' . $datos['id_cita'] : 'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nueva'; ?> Cita</h2>
        
        <div class="mb-3">
            <label for="InputCliente" class="form-label">Cliente</label>
            <select class="form-control" id="InputCliente" name="id_cliente" required>
                <?php foreach($clientes as $cliente): ?>
                    <option value="<?php echo htmlspecialchars($cliente['id_cliente'], ENT_QUOTES, 'UTF-8'); ?>"
                        <?php echo (isset($datos['id_cliente']) && $datos['id_cliente'] == $cliente['id_cliente']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cliente['nombre_completo'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="mb-3">
            <label for="InputFechaCita" class="form-label">Fecha de la Cita</label>
            <input type="datetime-local" class="form-control" id="InputFechaCita" name="fecha_cita" required="required" value="<?php echo (isset($datos["fecha_cita"])) ? htmlspecialchars($datos["fecha_cita"], ENT_QUOTES, 'UTF-8') : ''; ?>">
        </div>
        
        <div class="mb-3">
            <label for="InputNotas" class="form-label">Notas</label>
            <textarea class="form-control" id="InputNotas" name="notas" rows="3"><?php echo (isset($datos["notas"])) ? htmlspecialchars($datos["notas"], ENT_QUOTES, 'UTF-8') : ''; ?></textarea>
        </div>
        
        <div class="mb-3">
            <label for="InputEstadoCita" class="form-label">Estado de la Cita</label>
            <select class="form-control" id="InputEstadoCita" name="id_estado_cita" required="required">
            <?php foreach( $marcas as $marca ): 
                    $selected = '';
                    if($marca['id_estado_cita'] == $datos['id_estado_cita']):
                        $selected = 'selected';
                    endif;
                ?>
                <option value="<?php echo $marca['id_estado_cita']; ?>"<?php echo $selected ; ?>><?php echo $marca['estado_cita'] ;?></option>
                <?php endforeach; ?>
        </select>
        </div>
        
        <input type="submit" class="btn btn-primary" name="save" value="Guardar">
    </form>
</div>
