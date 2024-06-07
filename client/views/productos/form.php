<div class="container">
    <form action="productos.php?action=<?php echo ($action == 'update') ? 'change&id_producto=' . $datos['id_producto'] : 'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nuevo'; ?> Producto</h2>
        <div class="mb-3">
            <label for="Inputproducto" class="form-label">Producto</label>
            <input type="text" class="form-control" id="Inputproducto" name="producto" required="required" value="<?php echo (isset($datos["producto"])) ? $datos["producto"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="Inputprecio" class="form-label">Precio</label>
            <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" id="Inputprecio" name="precio" value="<?php echo (isset($datos["precio"])) ? $datos["precio"] : ''; ?>">
            </div>
        </div>        
        <div class="mb-3">
            <label for="Inputid_marca" class="form-label">Marca </label>
            <select for="Inputid_marca" class="form-select" name="id_marca">
                <?php foreach( $marcas as $marca ): 
                    $selected = '';
                    if($marca['id_marca'] == $datos['id_marca']):
                        $selected = 'selected';
                    endif;
                ?>
                <option value="<?php echo $marca['id_marca']; ?>"<?php echo $selected ; ?>><?php echo $marca['marca'] ;?></option>
                <?php endforeach; ?>                
            </select>            
        </div>
        <?php if($action == 'update'): ?>
            <div class="mb-3">
                <img src="/uploads/productos/<?php echo $datos['fotografia']; ?>" >
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="Inputfotografia" class="form-label">Fotografia</label>
            <input type="file" class="form-control" id="Inputfotografia" name="fotografia" value="<?php echo (isset($datos["fotografia"])) ? $datos["fotografia"] : ''; ?>">
        </div>
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>