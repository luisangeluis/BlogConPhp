<?php
include_once 'app/EscritorDeEntradas.inc.php';
$titulo = 'buscar';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

include_once 'app/CValidadorBuscador.inc.php';

$terminoABuscar = null;

if (isset($_POST['buscar']) && isset($_POST['termino-a-buscar']) && !empty($_POST['termino-a-buscar'])) {
    //TO DO
    //Hacer validaciones con el termino a buscar $terminoAbuscar

    $terminoABuscar = $_POST['termino-a-buscar'];

    $validador = new CValidadorBuscador($terminoABuscar);

    if ($validador->terminoCorrecto()) {
        //Conexion::openConexion();
        $resultados = CRepositorioEntrada::busquedaEntradaTodosLosCampos(Conexion::getConexion(), $terminoABuscar);
    }
}

?>

<div class="container ">
    <div class="jumbotron ">
        <h1 class="text-center align-self-center mx-auto">Resultado de busqueda</h1>
        <br>
        <div class="row">
            <div class="col-lg-2"></div>
            <div class="col-lg-8">
                <form action="" role="form" method="Post" action="<?php echo RUTA_BUSCADOR ?>">
                    <div class="form-group mb-3">
                        <input type="search" class="form-control" placeholder="¿Qué buscas?" name="termino-a-buscar" required value="<?php echo $terminoABuscar ?>">
                    </div>
                    <button class="form-control btn btn-primary btn-buscador" type="submit" name="buscar">BUSCAR</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>
                <?php
                if (count($resultados)) {
                    echo '<small>' . count($resultados) . '</small> resultados';
                }

                ?>
            </h1>
        </div>
    </div>

    <?php
    if (count($resultados)) {
        EscritorioDeEntradas::mostrarEntradasBusqueda($resultados);
    } else {
    ?>
        <p>No existen coincidencias</p>
    <?php

    }
    ?>

</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>