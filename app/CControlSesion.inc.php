<?php
class CControlSesion
{

    public static function openSession($pIdUsuario, $pNombreUsuario)
    {
        if (session_id() == '') {
            session_start();
        }

        $_SESSION['idUsuario'] = $pIdUsuario;
        $_SESSION['nombreUsuario'] = $pNombreUsuario;
    }

    public static function closeSession()
    {
        if (session_id() == '') {
            session_start();
        }

        if (isset($_SESSION['idUsuario'])) {
            unset($_SESSION['idUsuario']);
        }
        if (isset($_SESSION['nombreUsuario'])) {
            unset($_SESSION['nombreUsuario']);
        }

        session_destroy();
    }

    public static function sesionIniciada(){
        if (session_id() == '') {
            session_start();
        }

        if( isset($_SESSION['idUsuario']) && isset($_SESSION['nombreUsuario']) ){
            return true;
        }else{
            return false;
        }

    }
}
