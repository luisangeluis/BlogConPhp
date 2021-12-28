<?php
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/CEntrada.inc.php';
include_once 'app/CRepositorioEntrada.inc.php';
include_once './app/CValidadorEntrada.inc.php';
include_once './app/CControlSesion.inc.php';
include_once './app/Redireccion.inc.php';

$entradaPublica = 0;

if(isset($_POST['guardar'])){
    Conexion::getConexion();

    $validador = new CValidadorEntrada($_POST['Titulo'],$_POST['url'],htmlspecialchars($_POST['texto']),Conexion::getConexion());

    if(isset($_POST['check']) && $_POST['check'] == 'publica'){
        $entradaPublica = 1;
    }

    if($validador->validarFormulario()){

        if(CControlSesion::sesionIniciada()){
            $entrada = new CEntrada('',$_SESSION['idUsuario'],$validador->getUrl(),$validador->getTitulo(),
                $validador->getTexto(),'',$entradaPublica);
            
            $entradaInsertada = CRepositorioEntrada::insertarEntrada(Conexion::getConexion(),$entrada);

            if($entradaInsertada){
                Redireccion::Redirigir(RUTA_GESTOR_ENTRADAS);
            }

        }else{
            Redireccion::Redirigir(RUTA_LOGIN);
        }
        
        Conexion::closeConexion();

    }

}

$titulo = 'Nueva entrada del blog';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
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
                    <input type="checkbox" class="form-check-input" id="exampleCheck1" value="publica" name="check">
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