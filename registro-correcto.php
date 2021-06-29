<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';
include_once 'app/Redireccion.inc.php';


if( isset($_GET['nombre']) && !empty($_GET['nombre'])){
    echo 'hola '.$_GET['nombre'];
}else{
    echo 'no hay nombre';
}
if( isset($_GET['id']) && !empty($_GET['id'])){
    echo ' id '.$_GET['id'];
}else{
    echo 'no hay id';
}