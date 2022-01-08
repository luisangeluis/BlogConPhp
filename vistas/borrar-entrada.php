<?php
    include_once './app/config.inc.php';
    include_once './app/CRepositorioEntrada.inc.php';
    include_once './app/Redireccion.inc.php';
    include_once './app/Conexion.inc.php';

    if(isset($_POST['borrar-entrada'])){
        $idEntrada = $_POST['id-borrar'];

        Conexion::openConexion();
        
        CRepositorioEntrada::borrarEntradaYComentarios(Conexion::getConexion(),$idEntrada);

        Conexion::getConexion();

        Redireccion::Redirigir(RUTA_GESTOR_ENTRADAS);

    }
?>