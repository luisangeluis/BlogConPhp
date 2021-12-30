<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';
include_once 'app/Redireccion.inc.php';


// if (isset($_GET['nombre']) && !empty($_GET['nombre'])) {
//     $nombre = $_GET['nombre'];
// } else {
//     Redireccion::Redirigir(SERVIDOR);
// }
echo $usuarioInsertado;

$titulo = 'Registro correcto!';
include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
    <div class="row">
        <div class="col-lg-12  justify-content-center">
            <div class="card text-center mt-5">
                <div class="card-header">
                    <p></p>
                </div>
                <div class="card-body py-5">
                    <h5 class="card-title"> <span><i class="far fa-check-circle"></i></span> Felicidades <?php echo $nombre ?> te has registrado correctamente!</h5>
                    <p class="card-text">Muchas gracias por registrarte</p>
                    <a href="<?php echo RUTA_LOGIN?>" class="btn btn-primary">Iniciar Sesion</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>