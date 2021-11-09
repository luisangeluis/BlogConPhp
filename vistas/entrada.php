    <?php

    $titulo = $entrada->getTitulo();
    include_once './app/EscritorDeEntradas.inc.php';

    include_once 'plantillas/documento-declaracion.inc.php';
    include_once 'plantillas/navbar.inc.php';
    ?>
   
    <div class="contenido-articulo">
        <div class="container bg-light py-5 px-5 my-3 mx-auto">
            <div class="row">
                <div class="col-lg-12">
                    <h1>
                        <?php
                        echo $entrada->getTitulo();
                        ?>
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p>
                        Por
                        <a href="#"><i class="fas fa-user"><?php echo ' ' . $usuario->getNombre() ?></i></a>
                        el
                        <?php echo $entrada->getTitulo(); ?>
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <article class=" text-break text">
                        <?php
                        echo nl2br($entrada->getTexto());
                        ?>
                    </article>

                </div>
            </div>
        </div>
    </div>

    <?php
    include_once 'plantillas/documento-cierre.inc.php';
    ?>