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
        // echo 'hay resultados';
        // echo count($resultados);
    }
}

//if (isset($_POST['busqueda-avanzada']) && isset($_POST['termino-a-buscar']) && !empty($_POST['termino-a-buscar'])) {
if (isset($_POST['busqueda-avanzada'])) {
    $resultadosMultiples = true;

    $campos = [];
    $fecha = '';

    if (!isset($_POST['campos'])) {
        array_push($campos, 'titulo');
    } else {
        $campos = $_POST['campos'];
    }

    if ($_POST['fecha'] == "desc") {
        $fecha = 'desc';
    } else {
        $fecha = "asc";
    }

    $validadorAvanzado = new CValidadorBuscadorAvanzado($_POST['termino-a-buscar'], $campos, $fecha);
    $entradasByTitulo = [];
    $entradasByContenido = [];
    $entradasByAutor = [];
    if ($validadorAvanzado->isFormValido()) {

        Conexion::openConexion();
        if (in_array("titulo", $validadorAvanzado->getArrayCampos())) {
            // echo "titulo";
            $entradasByTitulo = CRepositorioEntrada::busquedaEntradaByTitulo(
                Conexion::getConexion(),
                $validadorAvanzado->getTermino(),
                $validadorAvanzado->getFecha()
            );
        }
        if (in_array("contenido", $validadorAvanzado->getArrayCampos())) {
            // echo "contenido";
            $entradasByContenido = CRepositorioEntrada::busquedaEntradaByTexto(
                Conexion::getConexion(),
                $validadorAvanzado->getTermino(),
                $validadorAvanzado->getFecha()
            );
        }
        if (in_array("tags", $validadorAvanzado->getArrayCampos())) {
            // echo "tags";

        }
        if (in_array("autor", $validadorAvanzado->getArrayCampos())) {
            // echo "autor";
            $entradasByAutor = CRepositorioEntrada::busquedaEntradaByAutor(
                Conexion::getConexion(),
                $validadorAvanzado->getTermino(),
                $validadorAvanzado->getFecha()
            );
        }

        foreach ($validadorAvanzado->getArrayCampos() as $c)
            echo $c;
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

                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="campos[]" value="titulo" <?php
                                                                                                                                    if (isset($_POST['busqueda-avanzada'])) {
                                                                                                                                        if (in_array('titulo', $validadorAvanzado->getArrayCampos())) {
                                                                                                                                            echo 'checked';
                                                                                                                                        }
                                                                                                                                    } else {
                                                                                                                                        echo 'checked';
                                                                                                                                    }
                                                                                                                                    ?>>
                                <label class="form-check-label" for="inlineCheckbox1">Titulo</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="campos[]" value="contenido" <?php
                                                                                                                                        if (isset($_POST['busqueda-avanzada'])) {
                                                                                                                                            if (in_array('contenido', $validadorAvanzado->getArrayCampos())) {
                                                                                                                                                echo 'checked';
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                        ?>>
                                <label class="form-check-label" for="inlineCheckbox2">Contenido</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="campos[]" value="tags" <?php
                                                                                                                                    if (isset($_POST['busqueda-avanzada'])) {
                                                                                                                                        if (in_array('tags', $validadorAvanzado->getArrayCampos())) {
                                                                                                                                            echo 'checked';
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                    ?>>
                                <label class="form-check-label" for="inlineCheckbox3">Tags</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" name="campos[]" value="autor" <?php
                                                                                                                                    if (isset($_POST['busqueda-avanzada'])) {
                                                                                                                                        if (in_array('autor', $validadorAvanzado->getArrayCampos())) {
                                                                                                                                            echo 'checked';
                                                                                                                                        }
                                                                                                                                    }
                                                                                                                                    ?>>
                                <label class="form-check-label" for="inlineCheckbox3">Autor</label>
                            </div>
                            <hr>
                            <p>Ordenar por:</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fecha" id="inlineRadio1" value="desc" <?php
                                                                                                                            if (isset($_POST['busqueda-avanzada'])) {
                                                                                                                                if ($validadorAvanzado->getFecha() === 'desc') {
                                                                                                                                    echo 'checked';
                                                                                                                                }
                                                                                                                            }
                                                                                                                            ?>>
                                <label class="form-check-label" for="inlineRadio1">Entradas mas recientes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="fecha" id="inlineRadio2" value="asc" <?php
                                                                                                                        if (isset($_POST['busqueda-avanzada'])) {
                                                                                                                            if ($validadorAvanzado->getFecha() === 'asc') {
                                                                                                                                echo 'checked';
                                                                                                                            }
                                                                                                                        }
                                                                                                                        ?>>
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
<div class="container" id="resultados">
    <div class="row">
        <div class="col-lg-12">
            <h2>Resultados:
                <?php

                if (isset($_POST['buscar']) && count($resultados)) {
                ?>
                    <small><?php echo count($resultados) ?></small>
                <?php
                } else if (isset($_POST['busqueda-avanzada'])) {

                    if (count($entradasByTitulo) || count($entradasByContenido) || count($entradasByAutor)) {
                        $numResultados = 0;
                        // echo 'holasssss';
                        if (count($entradasByTitulo)) {
                            echo "hay " . count($entradasByTitulo) . " entradas titulo";
                            $numResultados++;
                        }
                        if (count($entradasByContenido)) {
                            echo "hay " . count($entradasByContenido) . " entradas contenido";
                            $numResultados++;
                        }
                        if (count($entradasByAutor)) {
                            echo "hay " . count($entradasByAutor) . " entradas autor";
                            $numResultados++;
                        }
                    } else {
                        echo ' Sin resultados';
                    }
                }
                ?>
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php

            if (isset($_POST['buscar'])) {
                if (count($resultados)) {
                    EscritorioDeEntradas::mostrarEntradasbusqueda($resultados);
                } else {
            ?>
                    <h3>Sin Resultados</h3>
                    <br>
                <?php
                }
            } else if (isset($_POST['busqueda-avanzada'])) {

                if (count($entradasByTitulo) || count($entradasByContenido) || count($entradasByAutor)) {
                    // echo 'otra vez num de resultados '.$numResultados;
                    $numParametros = $numResultados;
                    $anchoColumnas = 12 / $numParametros;
                    // echo 'ancho de columnas: '.$anchoColumnas;

                ?>
                    <div class="row">

                        <?php
                        for ($i = 0; $i < $numParametros; $i++) {
                        ?>
                            <div class="<?php echo "col-lg-$anchoColumnas"; ?>">
                                <h4><?php echo 'Coincidencias en ' . $_POST['campos'][$i]; ?></h4>
                            </div>

                        <?php
                            switch ($_POST['campos'][$i]) {
                                case 'titulo':
                                    EscritorioDeEntradas::mostrarEntradasbusquedaMultiple($entradasByTitulo);
                                    break;
                                case 'contenido':
                                    // echo 'case de contenido';
                                    EscritorioDeEntradas::mostrarEntradasbusquedaMultiple($entradasByContenido);
                                    break;
                                case 'autor':
                                    EscritorioDeEntradas::mostrarEntradasbusquedaMultiple($entradasByAutor);
                                    break;
                            }
                        }
                        ?>
                    </div>
                <?php
                } else {
                ?>
                    <h3>Sin coincidencias</h3>
            <?php
                }
            }
            ?>
        </div>
    </div>

</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>