<div class="container">
    <form action="marcas.php?action=<?php echo($action=='update')?'change&id_marca='.$datos['id_marca']:'save'; ?>" method="post" enctype="multipart/form-data">
        <h2><?php echo ($action == 'update') ? 'Editar' : 'Nuevo'; ?> Marca</h2>
        <div class="mb-3">
            <label for="Inputmarca" class="form-label">marca</label>
            <input type="text" class="form-control" id="Inputmarca" name="marca" required="required" value="<?php echo (isset($datos["marca"])) ? $datos["marca"] : ''; ?>">
        </div>
        <?php if($action == 'update'): ?>
            <div class="mb-3">
                <img src="/uploads/marcas/<?php echo $datos['fotografia']; ?>" >
            </div>
        <?php endif; ?>
        <div class="mb-3">
            <label for="Inputfotografia" class="form-label">Fotografia</label>
            <input type="file" class="form-control" id="Inputfotografia" name="fotografia" value="<?php echo (isset($datos["fotografia"])) ? $datos["fotografia"] : ''; ?>">
        </div>
        <input type="submit" class="btn btn-primary" name="save" value="Guardar"></input>
    </form>
</div>