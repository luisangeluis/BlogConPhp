<?php
class Redireccion
{

    public static function Redirigir($pUrl)
    {
        //True es para que aparezca en la direccion donde estamos
        header('Location: '.$pUrl, true, 301);
        // Tambien se puede usar die();
        exit();
    }
}
