<?php
    include_once './app/CControlSesion.inc.php';
    include_once './app/Redireccion.inc.php';
    include_once './app/config.inc.php';

    CControlSesion:: closeSession();
    Redireccion::Redirigir(SERVIDOR);
?>