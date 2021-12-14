<?php
    include_once './plantillas/documento-declaracion.inc.php';
    include_once './plantillas/navbar.inc.php';
    include_once './plantillas/panelControlDeclaracion.inc.php';

    switch($gestorActual){
        case '':
            $entradasActivas = CRepositorioEntrada::getEntradasActivasUser(Conexion::getConexion(),$_SESSION['idUsuario']);
            $entradasInactivas = CRepositorioEntrada::getEntradasInactivasUser(Conexion::getConexion(),$_SESSION['idUsuario']);
            $cantidadComentarios = CRepositorioComentario::getComentariosUser(Conexion::getConexion(),$_SESSION['idUsuario']);
            
            include_once './plantillas/gestorGenerico.inc.php';    
        break;
        case 'entradas':
            include_once './plantillas/gestorEntradas.inc.php';    
        break;
        case 'comentarios':
            include_once './plantillas/gestorComentarios.inc.php';    
        break;
        case 'favoritos':
            include_once './plantillas/gestorFavoritos.inc.php';    
        break;
    }


    include_once './plantillas/panelControlCierre.inc.php';
    include_once './plantillas/documento-cierre.inc.php';
?>