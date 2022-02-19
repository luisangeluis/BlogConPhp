<?php

include_once './app/CRecuperacionPassword.inc.php';
include_once './app/CRepositorioRecuperacionPassword.inc.php';
include_once './app/CRepositorioUsuarios.inc.php';

Conexion::openConexion();

if (CRepositorioRecuperacionPassword::urlSecretaExiste(Conexion::getConexion(), $urlPersonal)) {
    $idUsuario = CRepositorioRecuperacionPassword::getIdUsuarioByUrlSecreta(Conexion::getConexion(), $urlPersonal);

    // echo 'id de usuario solicitante: ' . $idUsuario;
} else {
    echo '404';
}

if(isset($_POST['guardar-password'])){
    //Validaciones
    //Validar clave 1 y comprobar si la 2 coincide
    $validador = new CValidadorCambiarPassword($_POST['password1'],$_POST['password2']);

    if($validador->formValidado()){
        $passwordCifrado = password_hash($validador->getPassword(),PASSWORD_DEFAULT);

        $passwordActualizado = CRepositorioUsuarios::cambiarPassword(Conexion::getConexion(),$passwordCifrado,$idUsuario);

        if($passwordActualizado){
            // redirigir a pagina de actualizacion correcta y ofrecer link a login
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
                    <form role="form" method="POST" action="<?php echo RUTA_CAMBIAR_PASSWORD.'/'.$urlPersonal;?>">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Ingresa un nuevo password</label>
                            <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Escribe minimo 6 caracteres" name="password1" autofocus required>
                            <div id="emailHelp" class="form-text">Ingresa un nuevo password</div>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Repite tu nuevo password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Escribe minimo 6 caracteres" name="password2" required>
                            <div id="emailHelp" class="form-text">Repite tu nuevo password</div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg " name="guardar-password">Guardar password</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
<?php
include_once './plantillas/documento-cierre.inc.php';
?>