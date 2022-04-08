<?php
include_once 'app/Conexion.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';
include_once 'app/CControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';


$titulo = 'Perfil de usuario';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php';

if (!CControlSesion::sesionIniciada()) {
    Redireccion::Redirigir(SERVIDOR);
} else {
    Conexion::openConexion();
    $id = $_SESSION['idUsuario'];
    $usuario = CRepositorioUsuarios::GetUserById(Conexion::getConexion(), $id);
}


?>
<div class="container perfil bg-light text-dark">
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-9">
            <h4><small>Nombre de usuario </small></h4>
            <h4><?php echo $usuario->getNombre();?></h4>
            <br>
            <h4><small>Email de usuario </small></h4>
            <h4><?php echo $usuario->getEmail();?></h4>
            <br>
            <h4><small>Fecha de registro</small></h4>
            <h4><?php echo $usuario->getFechaRegistro();?></h4>

        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>