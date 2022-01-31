<?php

include_once './app/CRecuperacionPassword.inc.php';
include_once './app/CRepositorioRecuperacionPassword.inc.php';

Conexion:: openConexion();

if(CRepositorioRecuperacionPassword::urlSecretaExiste(Conexion::getConexion(),$urlPersonal)){
    $idUsuario = CRepositorioRecuperacionPassword::getIdUsuarioByUrlSecreta(Conexion::getConexion(),$urlPersonal);

    echo 'id de usuario solicitante: '.$idUsuario;
}else{
    echo '404';
}