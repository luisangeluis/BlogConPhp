<?php
//Permite que la imagen anterior no se quede guardada en la cache y se pueda guardar una imagen nueva forma correcta.
header('Expires: Tue, 01 Jan 2000 00:00:00 GMT');
header('Last-Modified: '.gmdate('D, d M Y H:i:s').'GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Cache-Control: post-check=0, pre-check=0',false);
header('Pragma: no-cache');

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
if (isset($_POST['guardar-imagen']) && !empty($_FILES['perfil_imagen']['tmp_name'])) {
    // echo 'hola';
    //Con ayuda de la constante y contatenando /subidas/ se obtiene la carpeta subidas
    //Revisar la configuracion de la constante DIRECTORIO_RAIZ
    $directorioSubidas = DIRECTORIO_RAIZ . '/subidas/';
    //Se obtiene la ruta completa, el nombre que maneja el archivo y se concatenan.
    $archivoObjetivo =  $directorioSubidas . basename($_FILES['perfil_imagen']['name']);
    $subidaCorrecta = 1;
    //pathinfo se obtiene el tipo de archivo que le pasamos como argumento.
    $tipoImagen = pathinfo($archivoObjetivo, PATHINFO_EXTENSION);
    //getimagesize nos ayuda a comprobar el tamaño de la imagen
    $imagenSize = getimagesize($_FILES['perfil_imagen']['tmp_name']);

    if ($imagenSize != false)
        $subidaCorrecta = 1;
    else
        $subidaCorrecta = 0;

    //Se comrueba el tamaño de la imagen no se mayor a 500 000 bytes
    if ($_FILES['perfil_imagen']['size'] > 500000) {


        echo 'El archivo no puede ser mayor a 500kb';
        $subidaCorrecta = 0;
    } else {
        //Se comprueba el tipo de imagen

        if ($tipoImagen == "jpg" || $tipoImagen == "png" || $tipoImagen == "jpeg" || $tipoImagen == "gif") {
            // echo 'Solo se admiten formatos jpg, png, jpeg, gif';
            $subidaCorrecta = 1;
        }
    }
    echo $tipoImagen;

    if (!$subidaCorrecta) {
        echo 'Tu archivo no puede subirse';
    } else {
        //move_uploaded_file() metodo para subir la imagen indicando la ruta y ademas el nombre con el que se guardara la imagen 
        if (move_uploaded_file($_FILES['perfil_imagen']['tmp_name'], DIRECTORIO_RAIZ . '/subidas/' . $usuario->getId())) {
            echo 'el archivo ' . basename($_FILES['perfil_imagen']['name']) . ' ha sido subido';
        } else {
            echo 'Ha ocurrido un error';
        }
    }
}
?>
<div class="container perfil bg-light text-dark">
    <div class="row py-1 py-lg-3">
        <div class="col-lg-3">
            <?php
            if (file_exists(DIRECTORIO_RAIZ . '/subidas/' . $usuario->getId())) {
            ?>
                <img src="<?php echo SERVIDOR.'/subidas/'.$usuario->getId()?>" class="img-fluid" alt="user-default">

            <?php
            } else {
            ?>
                <img src="./img/user-default.png" class="img-fluid" alt="user-default">

            <?php
            }
            ?>
            <br>
            <br>
            <form action="<?php echo RUTA_PERFIL ?>" method="POST" enctype="multipart/form-data" class="text-center">
                <label for="perfil_imagen" id="label_archivo" class="btn btn-outline-secondary laber_archivo">Sube una imagen</label>
                <input type="file" name="perfil_imagen" id="perfil_imagen" class="btn-subir">
                <br>
                <br>
                <input type="submit" value="guardar" name="guardar-imagen" class="btn btn-primary form-control">

            </form>
        </div>
        <div class="col-lg-9">
            <h4><small>Nombre de usuario </small></h4>
            <h4><?php echo $usuario->getNombre(); ?></h4>
            <br>
            <h4><small>Email de usuario </small></h4>
            <h4><?php echo $usuario->getEmail(); ?></h4>
            <br>
            <h4><small>Fecha de registro</small></h4>
            <h4><?php echo $usuario->getFechaRegistro(); ?></h4>

        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php';
?>