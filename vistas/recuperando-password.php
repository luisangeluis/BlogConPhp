<?php

include_once './app/CValidadorCambiarPassword.inc.php';
include_once './app/CRepositorioRecuperacionPassword.inc.php';

include_once './app/Redireccion.inc.php';

Conexion::openConexion();

if (CRepositorioRecuperacionPassword::urlSecretaExiste(Conexion::getConexion(), $urlPersonal)) {
    $idUsuario = CRepositorioRecuperacionPassword::getIdUsuarioByUrlSecreta(Conexion::getConexion(), $urlPersonal);

    // echo 'id de usuario solicitante: ' . $idUsuario;
} else {
    echo '404';
}

if (isset($_POST['guardar-password'])) {
    //Validaciones
    //Validar clave 1 y comprobar si la 2 coincide
    $validador = new CValidadorCambiarPassword($_POST['password1'], $_POST['password2']);

    if ($validador->formValidado()) {
        $passwordCifrado = password_hash($validador->getPassword(), PASSWORD_DEFAULT);

        $passwordActualizado = CRepositorioUsuarios::cambiarPassword(Conexion::getConexion(), $passwordCifrado, $idUsuario);

        if ($passwordActualizado) {
            // redirigir a pagina de actualizacion correcta y ofrecer link a login
            // Redireccion::Redirigir(RUTA_LOGIN);
        } else {
            echo 'ERROR';
        }
    }
}
Conexion::closeConexion();

$titulo = 'Recuperando password';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="card text-center">
                <div class="header">
                    <h4>Crea un nuevo password</h4>
                </div>
                <div class="card-body text-wrap">
                    <form role="form" method="POST" action="<?php echo RUTA_CAMBIAR_PASSWORD . '/' . $urlPersonal; ?>">
                        <?php
                        if (isset($_POST['guardar-password'])){
                            include_once'./plantillas/formCambiarPassValidado.inc.php';

                        }
                        else
                        include_once'./plantillas/formCambiarPassVacio.inc.php';
                        ?>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
include_once './plantillas/documento-cierre.inc.php';
?>