<?php
include_once './app/EscritorDeEntradas.inc.php';
?>
<div class="row">
    <div class="col-lg-12">
        <hr>
        <h3>Otras entradas interesantes</h3>
    </div>
    <?php
    for ($i = 0; $i < count($entradasAzar); $i++) {
        $entrada = $entradasAzar[$i];
    ?>
        
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <?php echo $entrada->getTitulo() ?>
                        <p>Autor<?php echo $entrada->getAutor()?></p>

                    </div>
                    <div class="card-body">
                        <div class="card-title"><?php echo nl2br($entrada->getFecha()) ?></div>
                        <div class="card-text ">
                            <?php echo nl2br(EscritorioDeEntradas::resumirTexto($entrada->getTexto())) 
                                 
                            ?>
                        </div>
                        <!-- <div class="text-center pt-3">
                            <a href="<?php echo RUTA_ENTRADA . '/' . $entrada->getUrl() ?>" class="btn btn-primary">Seguir leyendo</a>

                        </div> -->
                    </div>
                </div>
            </div>
        
    <?php
    }
    ?>
    <div class="col-lg-12">
        <hr>
    </div>

</div>