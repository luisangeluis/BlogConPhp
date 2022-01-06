<?php

// $nombreServidor='localhost:3307';
// $nombreUsuario='root';
// $password='' ;
// $nombreBaseDatos='blog'; 

define('nombreServidor','localhost:3307');
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

//Recursos
define('RUTA_CSS',SERVIDOR.'/styles');


?>