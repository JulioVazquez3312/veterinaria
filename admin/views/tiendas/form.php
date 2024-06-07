<div class="container">
    <form action="tiendas.php?action=<?php echo ($action == 'update') ? 'change&id_tienda=' . $datos['id_tienda'] : 'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nuevo'; ?> Tienda</h2>
        <div class="mb-3">
            <label for="Inputtienda" class="form-label">Tienda</label>
            <input type="text" class="form-control" id="Inputtienda" name="tienda" required="required" value="<?php echo (isset($datos["tienda"])) ? $datos["tienda"] : ''; ?>">
        </div>
        <div class="mb-3">  
            <label for="Inputlatitud" class="form-label">latitud</label>
            <input type="text" class="form-control" id="Inputlatitud" name="latitud" value="<?php echo (isset($datos["latitud"])) ? $datos["latitud"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="Inputlongitud" class="form-label">Longitud</label>
            <input type="text" class="form-control" id="Inputlongitud" name="longitud" value="<?php echo (isset($datos["longitud"])) ? $datos["longitud"] : ''; ?>">
        </div>
        <div class="mb-3">
        <label for="Inputfotografia" class="form-label">Fotografia</label>
        <?php if($action == 'update'): ?>
            <div class="mb-3">
                <img src="../uploads/tiendas/<?php echo $datos['fotografia']; ?>" width="25%" height="50%">
            </div>
        <?php endif; ?>
            <input type="file" class="form-control" id="Inputfotografia" name="fotografia" value="<?php echo (isset($datos["fotografia"])) ? $datos["fotografia"] : ''; ?>">
        </div>
        <div class="mb-3">
            <label for="Inputmapa" class="form-label">Mapa Actual</label>
            <div>
                <iframe class="iframe" src="https://maps.google.com/?ll=<?php echo $datos['latitud']; ?>,<?php echo $datos['longitud']; ?>&z=14&t=m&output=embed" height="600" width="600" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>