<?php
include_once './app/config.inc.php';
include_once './app/CRepositorioEntrada.inc.php';
include_once './app/Conexion.inc.php';
include_once './app/Redireccion.inc.php';



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

                    Conexion::openConexion();
                    
                    $entradaAEditar = CRepositorioEntrada::getEntradaById(Conexion::getConexion(),$idEntrada);

                    if(!is_null($entradaAEditar)){
                        include_once './plantillas/formEntradaAEditar.inc.php';
                    }
                    
                    Conexion::closeConexion();
                }
            ?>
            </form>
        </div>
    </div>
</div>
<?php
include_once './plantillas/documento-cierre.inc.php';
?>