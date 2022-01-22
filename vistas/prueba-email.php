<?php
$destinatario = 'correo@correo.com';
$asunto = 'prueba de correo';
$mensaje = 'Esto es un prueba de correo';

$emailEnviado = mail($destinatario,$asunto,$mensaje);
echo 'hola';
if($emailEnviado){
    echo 'email enviado';
}else{
    echo 'envío fallido';

}

?>