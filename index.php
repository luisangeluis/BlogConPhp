<?php
include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/CUsuario.inc.php';
include_once 'app/CEntrada.inc.php';
include_once 'app/CComentario.inc.php';

include_once 'app/CRepositorioUsuarios.inc.php';
include_once 'app/CRepositorioEntrada.inc.php';
include_once 'app/CRepositorioComentario.inc.php';


    //Las primeras 2 lineas obtienen la ruta
    $componentesUrl = parse_url($_SERVER["REQUEST_URI"]);
    $ruta = $componentesUrl['path'];
    // echo $ruta;
    // partesRuta divide la ruta en partes separadas por /
    // En esta linea la posicion 0 esta vacia la posicion 1 es la raiz y posicion 2 esta vacia
    $partesRuta = explode("/",$ruta);
    //array_filter deja las partes vacias como null
    $partesRuta = array_filter($partesRuta);
    //Crea un nuevo array ya sin los indices vacios del array y empieza a poner los resultados desde la posicion 0
    $partesRuta = array_slice($partesRuta,0);

    // if($partesRuta[2] === 'registro'){
    //     include 'vistas/registro.php';
    //     // echo 'if de registro';
    // }else if($partesRuta[2]==='login'){
    //     include_once 'vistas/login.php';
        
    // }else if($partesRuta[1]=='BlogConPhp'){
    //     include_once 'vistas/home.php';
    //     //  echo 'if de home';
    // }
    // else{
    //     echo '404';
    // }
    $rutaElegida = 'vistas/404.php';

    if($partesRuta[0]=='BlogConPhp'){
        if(count($partesRuta)==1){
            $rutaElegida = 'vistas/home.php';

        }else if(count($partesRuta)==2){
            // echo 'tiene 2 partes';
            switch($partesRuta[1]){
                case 'login':
                    $rutaElegida = 'vistas/login.php';
                break; 
                case 'logout':
                    $rutaElegida = 'vistas/logout.php';
                break;
                case 'registro':
                    $rutaElegida ='vistas/registro.php';
                break;
                case 'gestor':
                    $rutaElegida = 'vistas/gestor.php';
                break;
                case 'script-relleno':
                    $rutaElegida = 'vistas/ScriptRelleno.php';
                break;
            }
        }else if(count($partesRuta)==3){
            if($partesRuta[1]=='registro-correcto'){
                $nombre = $partesRuta[2];
                $rutaElegida = 'vistas/registro-correcto.php';
            }
            if($partesRuta[1] == 'entrada'){
                $url = $partesRuta[2];
                Conexion::openConexion();
                $entrada = CRepositorioEntrada :: getEntradaByUrl(Conexion::getConexion(),$url);

                if($entrada!=null){
                    $usuario = CRepositorioUsuarios::GetUserById(Conexion::getConexion(),$entrada -> getAutor());
                    echo "id de entrada".$entrada -> getId();
                    $comentarios = CRepositorioComentario::getComentarios(Conexion::getConexion(),$entrada -> getId());
                    // echo ($comentarios[0]->getTexto());
                    // $entradasAzar = CRepositorioEntrada::getEntradasAzar(Conexion::getConexion(),3);
                    // $entradasAzar = CRepositorioEntrada::getEntradasAzarByAutor(Conexion::getConexion(),$usuario,3);
                    $entradasAzar = CRepositorioEntrada::getEntradasAzar(Conexion::getConexion(),3);


                    $rutaElegida = 'vistas/entrada.php';
                }
            }
        }

    }
    include_once $rutaElegida;

?>