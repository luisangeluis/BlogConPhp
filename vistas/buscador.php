<?php
include_once 'app/EscritorDeEntradas.inc.php';
$titulo = 'buscar';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

include_once 'app/CValidadorBuscador.inc.php';
include_once 'app/CValidadorBuscadorAvanzado.inc.php';

$terminoABuscar = null;
$resultados = null;

$resultadosMultiples = null;

if (isset($_POST['buscar']) && isset($_POST['termino-a-buscar']) && !empty($_POST['termino-a-buscar'])) {
    $resultadosMultiples = false;

    $terminoABuscar = $_POST['termino-a-buscar'];

    $validador = new CValidadorBuscador($terminoABuscar);

    if ($validador->terminoCorrecto()) {
        //Conexion::openConexion();
        $resultados = CRepositorioEntrada::busquedaEntradaTodosLosCampos(Conexion::getConexion(), $terminoABuscar);
        echo 'hay resultados';
    }
}

// if (isset($_POST['busqueda-avanzada']) && isset($_POST['termino-a-buscar']) && !empty($_POST['termino-a-buscar'])) {
if (isset($_POST['busqueda-avanzada'])) {
    $resultadosMultiples = true;

    $campos = [];
    $fecha = '';

    if (!isset($_POST['campos'])) {
        array_push($campos, 'titulo');
    } else {
        $campos = $_POST['campos'];
    }

    if (!isset($_POST['fecha'])) {
        $fecha = 'recientes';
    } else {
        $fecha = $_POST['fecha'];
    }

    $validadorAvanzado = new CValidadorBuscadorAvanzado($_POST['termino-a-buscar'], $campos, $fecha);

    if ($validadorAvanzado->isFormValido()) {
        echo 'es valido';
    } else {

        echo 'no es valido';
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
                                <input type="search" class="form-control" placeholder="¿Qué buscas?" name="termino-a-buscar" value="<?php echo $terminoABuscar ?>">
                            </div>
                            <?php if (isset($_POST['busqueda-avanzada'])) {
                                $validadorAvanzado->mostrarErrorTermino();
                            } ?>
                            <p>Buscar en los siguientes campos:</p>
                            <div class="form-check form-check-inline">

                                <!--poner a todos los campos relacionados el mis name con corchetes ejem campos[]-->

                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="campos[]" value="titulo" checked>
                                <label class="form-check-label" for="inlineCheckbox1">Titulo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="campos[]" value="contenido">
                                <label class="form-check-label" for="inlineCheckbox2">Contenido</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="campos[]" value="tags">
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
                if (isset($resultados)) {
                    if (count($resultados)) {
                        echo '<small>' . count($resultados) . '</small> resultados';
                    }
                }
                ?>
            </h1>
        </div>
    </div>

    <?php

    //TO DO en el video se puso count en lugar de isset
    if (isset($resultados)) {
        if (!$resultadosMultiples) {
            EscritorioDeEntradas::mostrarEntradasBusqueda($resultados);
        } else {
            //mostrar resultados
        }
    } else {

        //Construir validador para termino a buscar avanzado y no usar variables post directamente
        if (isset($_POST['busqueda-avanzada'])) {
            $campos = count($validadorAvanzado->getArrayCampos());
            $anchoColumna = 12 / $campos;

    ?>
            <div class="row text-center">
                <?php
                for ($i = 0; $i < $campos; $i++) {
                ?>

                    <div class="<?php echo 'col-lg-'.$anchoColumna?>">
                        <h4><?php echo 'Resultados en ' .$validadorAvanzado->getArrayCampos()[$i]?></h4>
                        <br>
                    </div>

                <?php
                }
                ?>

            </div>

    <?php
        }
    }

    ?>

</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>