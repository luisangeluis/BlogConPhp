<?php

function crearStringAleatorio($pLongitud)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = "";

    for ($i = 0; $i < $pLongitud; $i++) {
        $string .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }

    return $string;
}


if(isset($_POST['enviar-email'])){
    //revisar en la bd si existe el email
    Conexion::openConexion();
    $email = $_POST['email'];
    if(!CRepositorioUsuarios::emailExiste(Conexion::getConexion(),$email)){
        return;
    }
    //Si email exixte recuperamos el user
    $usuario = CRepositorioUsuarios::getUserPorEmail(Conexion::getConexion(),$email);

    //Juntamos el user con el string aleatorio para crear la url unica
    $nombreUsuario = $usuario->getNombre();
    $StringAleatorio = crearStringAleatorio(10);
    
    //Se genera una url de 64 caracteres
    $urlSecreta = hash('sha256',$StringAleatorio.$nombreUsuario);

    Conexion::closeConexion();

}