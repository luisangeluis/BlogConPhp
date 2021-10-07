<?php
    //Las primeras 2 lineas obtienen la ruta
    $componentesUrl = parse_url($_SERVER["REQUEST_URI"]);
    $ruta = $componentesUrl['path'];
    // echo $ruta;
    // partesRuta divide la ruta en partes separadas por /
    $partesRuta = explode("/",$ruta);
    foreach($partesRuta as $parte){
        // echo $parte;
    }

    if($partesRuta[2] === 'registro'){
        include 'vistas/registro.php';
        // echo 'if de registro';
    }else if($partesRuta[2]==='login'){
        include_once 'vistas/login.php';
        
    }else if($partesRuta[1]=='BlogConPhp'){
        include_once 'vistas/home.php';
        //  echo 'if de home';
    }
    else{
        echo '404';
    }
?>