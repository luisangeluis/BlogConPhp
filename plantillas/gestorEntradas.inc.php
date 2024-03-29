<div class="row">
    <div class="col-lg-12">
        <h2>Gestor Entradas</h2>

        <a href="<?php echo RUTA_NUEVA_ENTRADA ?>" class="btn btn-primary btn-lg btn-Gestor-uno" role="button">Crear Entrada</a>
        <br>
        <br>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <?php
        if (count($arrayEntradas)) {
        ?>
            <table class="table bg-light text-center">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Título</th>
                        <th scope="col">Estado</th>
                        <th scope="col">comentarios</th>
                        <th scope="col"></th>
                        <th scope="col"></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($i = 0; $i < count($arrayEntradas); $i++) {
                        $entradaActual = $arrayEntradas[$i][0];
                        $comentariosEntradaActual  = $arrayEntradas[$i][1];
                    ?>
                        <tr>
                            <td><?php echo $entradaActual->getFecha() ?></td>
                            <td><?php echo $entradaActual->getTitulo() ?></td>
                            <td><?php echo $entradaActual->getActiva() ?></td>
                            <td><?php echo $comentariosEntradaActual ?></td>
                            <td>
                                <form action="<?php echo RUTA_EDITAR_ENTRADA?>" method="POST">
                                    <input type="hidden" name="id-editar" value="<?php echo $entradaActual->getId()?>">
                                    <button type="submit" class="btn btn-primary btn-sm" name="editar-entrada">Editar</button>
                                </form>
                            </td>
                            <td>
                                <form action="<?php echo RUTA_BORRAR_ENTRADA ?>" method="post">
                                    <input type="hidden" name=id-borrar value="<?php echo $entradaActual->getId() ?>">
                                    <button type="submit" class="btn btn-primary btn-sm" name="borrar-entrada">Borrar</button>
                                </form>
                            </td>

                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        } else {
        ?>
            <h3 class="tex-center">Todavia no has escrito ninguna entrada</h3>
            <br>
        <?php
        }
        ?>

    </div>
</div>