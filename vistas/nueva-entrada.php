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

    $validador = new CValidadorEntrada($_POST['titulo'],$_POST['url'],htmlspecialchars($_POST['texto']),Conexion::getConexion());

    // echo $validador->getTitulo();
    if(isset($_POST['check']) && $_POST['check'] == 'publica'){
        $entradaPublica = 1;
    }

    if($validador->validarFormulario()){
        echo 'form validado';

        if(CControlSesion::sesionIniciada()){
            echo 'sesion iniciada';

            $entrada = new CEntrada('',$_SESSION['idUsuario'],$validador->getUrl(),$validador->getTitulo(),
                $validador->getTexto(),'',$entradaPublica);
            
            $entradaInsertada = CRepositorioEntrada::insertarEntrada(Conexion::getConexion(),$entrada);
            if($entradaInsertada){
                echo 'entrada insertada';
                // Redireccion::Redirigir(RUTA_GESTOR_ENTRADAS);
            }

        }else{
            echo 'sesion no iniciada';

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
                <?php
                    if(isset($_POST['guardar']))
                        include_once './plantillas/formNuevaEntradaValidado.inc.php';
                    else    
                        include_once './plantillas/formNuevaEntradaVacio.inc.php';

                ?>
            </form>
            <br>
        </div>
    </div>
</div>
<?php
include_once './plantillas/documento-cierre.inc.php';
?>