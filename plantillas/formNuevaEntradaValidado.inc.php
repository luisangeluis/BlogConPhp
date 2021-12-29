<div class="mb-3">
    <label for="titulo" class="form-label">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Escribe un titulo" <?php $validador->mostrarTituloEnPantalla() ?>>
    <?php
    $validador->mostrarErrorTituloEnPantalla();
    ?>
</div>
<div class="mb-3">
    <label for="url" class="form-label">Url</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="Escribe una url" <?php $validador->mostrarURLEnPantalla()?>>
    <?php
    $validador->mostrarErrorUrlEnPantalla();
    ?>
</div>
<div class="mb-3">
    <label for="contenido" class="form-label">Contenido</label>
    <textarea id="contenido" cols="30" rows="5" class="form-control" name="texto" placeholder="Escribe tu publicacion"><?php $validador->mostrarTextoEnPantalla()?></textarea>
    <?php
    $validador->mostrarErrorTextoEnPantalla();
    ?>
</div>
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="publica" name="check" <?php if($entradaPublica) echo 'checked';?>>
    <label class="form-check-label" for="exampleCheck1">Publicar de forma automatica</label>
</div>
<br>
<button type="submit" class="btn btn-primary" name="guardar">Publicar</button>