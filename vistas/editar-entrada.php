<?php
include_once './app/config.inc.php';
include_once './app/CRepositorioEntrada.inc.php';
include_once './app/CValidadorEntradaAEditar.php';
include_once './app/Conexion.inc.php';
include_once './app/Redireccion.inc.php';

Conexion::openConexion();

// if(CControlSesion::sesionIniciada()){

if(isset($_POST['guardar-cambios-entrada'])){
    $entradaPublicaNueva = 0;

    if(isset($_POST['publica']) && $_POST['publica'] == 'publica'){
        $entradaPublicaNueva = 1;
    }

    $validador = new CValidadorEntradaAEditar($_POST['titulo'],$_POST['titulo-original'],$_POST['url'],$_POST['url-original'],
    htmlspecialchars($_POST['texto']),$_POST['texto-original'],$entradaPublicaNueva,$_POST['publicar-original'],
        Conexion::getConexion());

    if($validador->hayCambios()){
        if($validador->validarFormulario()){
           
            //actualizar en bd
            $cambiosEfectuados = CRepositorioEntrada::updateEntrada(Conexion::getConexion(),$_POST['id-entrada'],
                $validador->getTitulo(),$validador->getUrl(),$validador->getTexto(),$validador->getCheckbox());

            if($cambiosEfectuados)
            //redireccionar a gestor entradas
            Redireccion::Redirigir(RUTA_GESTOR_ENTRADAS);
        }
    }else{
        Redireccion::Redirigir(RUTA_GESTOR_ENTRADAS);
    }
}
// }
$titulo = 'Editar entrada';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
?>
<div class="container">
    <div class="jumbotron rounded my-3 px-5 text-center align-items-center d-flex justify-content-center ">
        <h1 class="">Editar Entrada</h1>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form class="form-editar-entrada" method="POST" action="<?php echo RUTA_EDITAR_ENTRADA ?>">
            <?php
                if(isset($_POST['editar-entrada'])){
                    $idEntrada = $_POST['id-editar'];

                    
                    $entradaAEditar = CRepositorioEntrada::getEntradaById(Conexion::getConexion(),$idEntrada);

                    if(!is_null($entradaAEditar)){
                        include_once './plantillas/formEntradaAEditar.inc.php';
                    }
                    
                    Conexion::closeConexion();
                }else if(isset($_POST['guardar-cambios-entrada'])){
                    $idEntrada = $_POST['id-entrada'];
                    $entradaAEditar = CRepositorioEntrada::getEntradaById(Conexion::getConexion(),$idEntrada);

                    include_once './plantillas/formEntradaAEditarValidada.inc.php';
                    //plantilla validada
                }
            ?>
            </form>
        </div>
    </div>
</div>
<?php
include_once './plantillas/documento-cierre.inc.php';
?>