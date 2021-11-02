    <?php

        $titulo = $entrada->getTitulo();
        include_once './app/EscritorDeEntradas.inc.php';

        include_once 'plantillas/documento-declaracion.inc.php';
        include_once 'plantillas/navbar.inc.php';
    ?>
        <div class="container mt-3">
            <div class="row ">
                <div class="col-lg-9 mx-auto">
                    <?php
                        EscritorioDeEntradas :: escribirEntrada($entrada);
                    ?>
                </div>
            </div>
        </div>
    <?php
        include_once 'plantillas/documento-cierre.inc.php';
    ?>