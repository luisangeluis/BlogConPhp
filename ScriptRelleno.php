<?php
    include_once 'app/config.inc.php';
    include_once 'app/Conexion.inc.php';

    include_once 'app/CUsuario.inc.php';
    include_once 'app/CEntrada.inc.php';
    include_once 'app/CComentario.inc.php';

    include_once 'app/CRepositorioUsuarios.inc.php';
    include_once 'app/CRepositorioEntrada.inc.php';
    include_once 'app/CRepositorioComentario.inc.php';

    Conexion::openConexion();

    // for($usuarios =0; $usuarios<100; $usuarios++){
    //     $nombre = crearStringAleatorio(10);
    //     $email = crearStringAleatorio(5).'@'.crearStringAleatorio(3);
    //     $password = password_hash('12345',PASSWORD_DEFAULT);

    //     $usuario = new CUsuario('',$nombre,$email,$password,'','');
    //     CRepositorioUsuarios::InsertarUsuario(Conexion::getConexion(),$usuario);
    // }

    // for($entradas =0;$entradas<100;$entradas++){
    //     $autor = rand(1,100);
    //     $titulo = crearStringAleatorio(10);
    //     $texto = lorem();

    //     $entrada = new CEntrada('',$autor,$titulo,$texto,'','');
    //     CRepositorioEntrada::insertarEntrada(Conexion::getConexion(),$entrada);
    // }
    for($comentarios =0;$comentarios<3;$comentarios++){
        $autorId = rand(1,100);
        $entradaId = rand(1,100);
        $titulo = crearStringAleatorio(10);
        $texto = lorem();

        $comentario = new CComentario('',$autorId,$entradaId,$titulo,$texto,'');
        CRepositorioComentario::insertarComentario(Conexion::getConexion(),$comentario);
    }
    // print 'EL ID'.$comentario->getId();
    function crearStringAleatorio($pLongitud){
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string ="";

        for($i =0; $i<$pLongitud;$i++){
            $string .= $caracteres[rand(0,strlen($caracteres) -1)];

        }

        return $string;
    }

    function lorem(){
        $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac turpis blandit, pulvinar ipsum eu, faucibus risus. Duis suscipit rhoncus nisl, non imperdiet tellus scelerisque eu. Proin et maximus tellus. In viverra condimentum ligula, in iaculis libero placerat vel. Sed et maximus nisl. Vestibulum ut nunc vel arcu rhoncus commodo quis quis nisi. Integer ut porttitor turpis. In condimentum arcu leo, eu porta libero molestie eu. Donec tristique leo magna, ac bibendum mi mattis id. Vestibulum eu varius elit. Sed porta nulla accumsan ipsum convallis mollis a eget elit. Maecenas maximus dolor vitae ipsum egestas dictum. Quisque non nisl posuere, condimentum diam pretium, accumsan libero. In sed urna eu purus fermentum commodo sit amet et urna. Cras et dictum mauris. Ut dignissim metus at viverra mollis.

        Praesent ornare ornare eros. Integer tempor condimentum justo, quis tincidunt metus tristique vel. Integer scelerisque libero vel gravida commodo. Vivamus dapibus, arcu non aliquam scelerisque, felis est ultricies leo, sed gravida nibh turpis ac lorem. Donec fermentum, est eget blandit volutpat, est nunc pulvinar turpis, ut consequat turpis felis eu sem. Ut sollicitudin est et mi condimentum, ac lobortis risus sagittis. Nunc scelerisque elit sit amet mollis egestas. Mauris ultricies consectetur lorem eu convallis. Aliquam aliquet rhoncus nibh ac sollicitudin. Donec venenatis ex sit amet porttitor bibendum. Praesent ipsum augue, porttitor ac dignissim sed, euismod sed ante. Integer maximus nisi eget bibendum consequat. Vivamus quis velit in elit aliquet ultricies non ac ligula. Duis molestie volutpat ligula at fringilla.

        Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Cras accumsan dui quis tempor placerat. Curabitur et condimentum odio. Morbi sollicitudin rhoncus justo, non venenatis felis tempus sit amet. Nunc ultricies sagittis eros, ut blandit orci semper at. Nullam dapibus id nunc interdum posuere. Morbi tincidunt nec erat non fermentum. Donec rutrum ipsum nec vestibulum congue. Aliquam efficitur, metus et consequat volutpat, quam mauris molestie nibh, a feugiat dui mauris a leo. Nam leo arcu, imperdiet eget tincidunt in, pretium vel lacus. Nam vehicula sapien id ullamcorper sollicitudin. Vestibulum fermentum ornare purus et iaculis. Donec tellus est, gravida sit amet posuere at, iaculis vel leo. Phasellus blandit, massa id malesuada suscipit, ipsum eros maximus nulla, euismod blandit dui nulla malesuada nibh. Proin consequat ligula nisi, sed venenatis orci elementum eget. Nulla facilisi.

        Nullam pulvinar aliquam ullamcorper. Sed volutpat molestie tellus a cursus. Aliquam et pellentesque felis. Quisque ac sem scelerisque, viverra sem a, laoreet nulla. Nullam fringilla quis ex vel faucibus. Praesent sollicitudin cursus lectus, et semper libero aliquam ut. Duis sagittis, lorem quis euismod suscipit, risus felis venenatis risus, sed sodales urna leo vel nibh. Curabitur volutpat vel tortor sit amet lobortis. Vivamus ac luctus elit, vitae tincidunt nisl. Ut posuere tincidunt ante, ac condimentum lectus iaculis ac. Phasellus vitae erat quis metus consequat pulvinar. Proin quis placerat enim. Proin interdum velit a dolor sodales mollis. Donec pulvinar eleifend mauris, eget ornare felis fringilla in. Vestibulum in sapien ex.

        Nam ullamcorper eget mi ac egestas. Praesent cursus ex a tempor malesuada. Fusce dignissim nisi sit amet felis sollicitudin sollicitudin. Fusce et finibus odio. Pellentesque at euismod tellus, vel tristique tellus. Morbi pharetra posuere nisl eget rhoncus. Vivamus suscipit risus leo, nec venenatis dolor tincidunt quis. Ut tellus velit, molestie at est at, tristique vehicula ante. Morbi finibus venenatis suscipit. Sed nec eros rutrum, eleifend risus eu, finibus arcu. Sed sapien dolor, vehicula vel libero eu, pulvinar egestas dolor. Sed sagittis justo quis lorem cursus, sed congue felis laoreet. In egestas justo ac turpis viverra, sit amet consequat lacus facilisis. Donec vitae tincidunt felis.'
        ;
        return $lorem;
    }
?>

