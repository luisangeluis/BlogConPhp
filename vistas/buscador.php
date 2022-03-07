<?php
include_once 'app/EscritorDeEntradas.inc.php';
$titulo = 'buscar';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

include_once 'app/CValidadorBuscador.inc.php';

$terminoABuscar = null;
$resultados =null;

if (isset($_POST['buscar']) && isset($_POST['termino-a-buscar']) && !empty($_POST['termino-a-buscar'])) {
    
    $terminoABuscar = $_POST['termino-a-buscar'];

    $validador = new CValidadorBuscador($terminoABuscar);

    if ($validador->terminoCorrecto()) {
        //Conexion::openConexion();
        $resultados = CRepositorioEntrada::busquedaEntradaTodosLosCampos(Conexion::getConexion(), $terminoABuscar);
    }
}

if (isset($_POST['busqueda-avanzada']) && isset($_POST['termino-a-buscar']) && !empty($_POST['termino-a-buscar'])) {
    
    $terminoABuscar = $_POST['termino-a-buscar'];

    print_r($_POST['campos']);
    echo $_POST['fecha'];
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
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">

                    <a class="text-white" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Busqueda avanzada
                    </a>

                </div>
                <div class="collapse show" id="collapseExample">
                    <div class="card card-body">
                        <form action="" role="form" method="Post" action="<?php echo RUTA_BUSCADOR ?>">
                            <div class="form-group mb-3">
                                <input type="search" class="form-control" placeholder="¿Qué buscas?" name="termino-a-buscar" required value="<?php echo $terminoABuscar ?>">
                            </div>
                            <p>Buscar en los siguientes campos:</p>
                            <div class="form-check form-check-inline">

                                <!--poner a todos los campos relacionados el mis name con corchetes ejem campos[]-->

                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="campos[]" value="titulo" checked>
                                <label class="form-check-label" for="inlineCheckbox1">Titulo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="campos[]" value="contenido" checked>
                                <label class="form-check-label" for="inlineCheckbox2">Contenido</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="campos[]" value="tags" checked>
                                <label class="form-check-label" for="inlineCheckbox3">Tags</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="campos[]" value="autor">
                                <label class="form-check-label" for="inlineCheckbox3">Autor</label>
                            </div>
                            <hr>
                            <p>Ordenar por:</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fecha" id="inlineRadio1" value="recientes" checked>
                                <label class="form-check-label" for="inlineRadio1">Entradas mas recientes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fecha" id="inlineRadio2" value="antiguas">
                                <label class="form-check-label" for="inlineRadio2">Entradas mas antigüas</label>
                            </div>
                            <hr>
                            <button class=" btn btn-primary btn-buscador" type="submit" name="busqueda-avanzada">Busqueda Avanzada</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>
                <?php
                if(isset($resultados)){
                    if (count($resultados)) {
                        echo '<small>' . count($resultados) . '</small> resultados';
                    }
                }
                

                ?>
            </h1>
        </div>
    </div>

    <?php
    if(isset($resultados)){
        if (count($resultados)) {
            EscritorioDeEntradas::mostrarEntradasBusqueda($resultados);
        } else {
        ?>
            <p>No existen coincidencias</p>
        <?php
    
        }
        
    }
    ?>

</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>