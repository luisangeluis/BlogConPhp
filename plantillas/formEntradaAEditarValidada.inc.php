<input type="hidden" name="id-entrada" value="<?php echo $idEntrada;?>">
<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Escribe un titulo" 
        value="<?php echo $validador->getTitulo();?>">
       
    <input type="hidden" name="titulo-original" value="<?php echo $entradaAEditar->getTitulo();?>">
    <?php
        $validador ->mostrarErrorTituloEnPantalla();
    ?>
</div>
<div class="mb-3">
    <label for="url" class="form-label">Url</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="Escribe una url"
        value="<?php echo $validador->getUrl()?>">
    <input type="hidden" name="url-original" value="<?php echo $entradaAEditar->getUrl();?>">
    <?php
        $validador ->mostrarErrorUrlEnPantalla();
    ?>
</div>
<div class="mb-3">
    <label for="contenido" class="form-label">Contenido</label>
    
    <textarea id="contenido" cols="30" rows="5" class="form-control" name="texto" placeholder="Escribe tu publicacion"><?php echo $validador->getTexto();?></textarea>
    <input type="hidden" name="texto-original" value="<?php echo $entradaAEditar->getTexto();?>">
    <?php
        $validador ->mostrarErrorTextoEnPantalla();
    ?>
</div>
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="publica" name="publica" <?php if($validador->getCheckbox()) echo 'checked';?>>
    <input type="hidden" name="publicar-original" value="<?php echo $entradaAEditar->estaActiva();?>">
    <label class="form-check-label" for="exampleCheck1">Publicar de forma automatica</label>
</div>
<br>
<button type="submit" class="btn btn-primary" name="guardar-cambios-entrada">Guardar Cambios.</button>