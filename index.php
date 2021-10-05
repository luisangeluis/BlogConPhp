<?php
    //Las primeras 2 lineas obtienen la ruta
    $componentesUrl = parse_url($_SERVER["REQUEST_URI"]);
    $ruta = $componentesUrl['path'];
    echo $ruta;
    // partesRuta divide la ruta en partes separadas por /
    $partesRuta = explode("/",$ruta);

    if($partesRuta[2] == 'registro'){
        include_once 'vistas/login.php';
    }else if($partesRuta[1]=='BlogConPhp'){
        include_once 'vistas/home.php';
        echo 'hola';
    }else{
        echo '404';
    }
?>