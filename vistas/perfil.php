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

//$_FILES['perfil_imagen']['tmp_name'] se obtiene el nombre temporal de la imagen para saber
//si en realidad se selecciono una imagen.
if(isset($_POST['guardar-imagen']) && !empty($_FILES['perfil_imagen']['tmp_ name'])){
    //Con ayuda de la constante y contatenando /subidas/ se obtiene la carpeta subidas
    //Revisar la configuracion de la constante DIRECTORIO_RAIZ
    $directorioImages = DIRECTORIO_RAIZ.'/subidas/';
    //Se obtiene la ruta completa, el nombre que maneja el archivo y se concatenan.
    $archivoObjetivo =  $directorio.basename($_FILES['perfil_imagen']['name']);
}
?>
<div class="container perfil bg-light text-dark">
    <div class="row py-1 py-lg-3">
        <div class="col-lg-3">
            <img src="./img/user-default.png" class="img-fluid"alt="user-default">
            <form action="<?php echo RUTA_PERFIL?>" method="POST" enctype="multipart/form-data" class="text-center">
                <label for="perfil_imagen" id="label_archivo" class="btn btn-outline-secondary laber_archivo">Sube una imagen</label>
                <input type="file" name="perfil_imagen" id="perfil_imagen" class="btn-subir">
                <br>
                <br>
                <input type="submit" value="guardar" name="guardar-imagen" class="btn btn-primary form-control">
                
            </form>
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