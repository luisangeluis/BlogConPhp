<div class="row">
    <div class="col-lg-12">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <?php echo "Ver comentarios  (" . count($comentarios) . ")" ?>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php
                        for ($i = 0; $i < count($comentarios); $i++) {
                            $comentario = $comentarios[$i];

                        ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $comentario->getTitulo() ?></h5>
                                            <div class="col-lg-2">
                                                <p class="card-text"><?php echo $comentario->getAutorId() ?></p>

                                            </div>
                                            <div class="col-lg-10">
                                                <p class="card-text"><?php echo $comentario->getFecha() ?></p>
                                                <!-- <p class="card-text"><?php echo $comentarios -> getTexto()?></p> -->
                                            </div>
                                            <a href="#" class="btn btn-primary">Go somewhere</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>


        </div>
    </div>
</div>