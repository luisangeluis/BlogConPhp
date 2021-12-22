<?php
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/CUsuario.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';

$titulo = 'Nueva entrada del blog';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';

if(isset($_POST['enviar'])){
    echo $_POST['titulo'];
}
?>
<div class="container">
    <div class="jumbotron rounded my-3 px-5 text-center align-items-center d-flex justify-content-center ">
        <h1 class="">Nueva entrada</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form class="form-uno" method="POST" action="<?php echo RUTA_NUEVA_ENTRADA?>">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Titulo</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Escribe un titulo">
                </div>
                <div class="mb-3">
                    <label for="url" class="form-label">Url</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Escribe una url">
                </div>
                <div class="mb-3">
                    <label for="contenido" class="form-label">Contenido</label>
                    <textarea name="" id="contenido" cols="30" rows="5" class="form-control" name="contenido" placeholder="Escribe tu publicacion"></textarea>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="publica" name="checked">
                    <label class="form-check-label" for="exampleCheck1">Publicar de forma automatica</label>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="guardar">Publicar</button>
            </form>
            <br>
        </div>
    </div>
</div>
<?php
include_once './plantillas/documento-cierre.inc.php';
?>