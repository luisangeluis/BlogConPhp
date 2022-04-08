<?php

// $nombreServidor='localhost:3307';
// $nombreUsuario='root';
// $password='' ;
// $nombreBaseDatos='blog'; 

define('nombreServidor','localhost:3306');
define('nombreUsuario','root');
define('password','');
define('nombreBaseDatos','blog');

//Rutas de la web
define('SERVIDOR','http://localhost/BlogConPhp');
define('RUTA_REGISTRO', SERVIDOR.'/registro');
define('RUTA_REGISTRO_CORRECTO', SERVIDOR.'/registro-correcto');
define('RUTA_LOGIN', SERVIDOR.'/login');
define('RUTA_LOGOUT',SERVIDOR.'/logout');
define('RUTA_ENTRADA',SERVIDOR.'/entrada');
define('RUTA_GESTOR',SERVIDOR.'/gestor');
define('RUTA_GESTOR_ENTRADAS',RUTA_GESTOR.'/entradas');
define('RUTA_GESTOR_COMENTARIOS',RUTA_GESTOR.'/comentarios');
define('RUTA_GESTOR_FAVORITOS',RUTA_GESTOR.'/favoritos');
define('RUTA_NUEVA_ENTRADA',SERVIDOR.'/nueva-entrada');
define('RUTA_BORRAR_ENTRADA',SERVIDOR. '/borrar-entrada');
define('RUTA_EDITAR_ENTRADA',SERVIDOR.'/editar-entrada');
define('RUTA_RECUPERAR_PASSWORD',SERVIDOR.'/recuperar-password');
define('RUTA_GENERAR_URL_SECRETA',SERVIDOR.'/generar-url-secreta');
define('RUTA_ENVIAR_EMAIL',SERVIDOR.'/enviar-email');
define('RUTA_CAMBIAR_PASSWORD',SERVIDOR.'/recuperando-password');
define('RUTA_BUSCADOR',SERVIDOR.'/buscador');
define('RUTA_PERFIL',SERVIDOR.'/perfil');


define('RUTA_PRUEBAS',SERVIDOR.'/pruebas-grales');

//Recursos
define('RUTA_CSS',SERVIDOR.'/styles');


?>