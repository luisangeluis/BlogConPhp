<?php

include_once 'app/CRepositorioUsuarios.inc.php';

class CValidadorLogin{

    private $usuario; 
    private $error;

    public function __construct($pCorreo,$pClave,$pConexion)
    {   
        $this->error = "";
        if($pCorreo==null || $pClave==null){
            $this->error = "Debes escribir tu usuario y contraseña";
        }else{
            $usuario = CRepositorioUsuarios::getUserPorEmail($pConexion,$pCorreo);  

            if(is_null($this->usuario) || !password_verify($pClave, $this->usuario->getPassword())){
                $this->error = "Datos incorrectos";
            }
        }
    }

    private function variableIniciada($variable)
    {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {    
            return false;
        }
    }

    public function getUsuario(){
        return $this->usuario;
    }

    public function getError(){
        return $this->error;

    }
    
    public function mostrarError(){
        if($this->error!==""){
            echo "<br><div class='alert alert-danger' role='alert'>";
            echo $this->error;
            echo "</div><br>";

        }
    }
}