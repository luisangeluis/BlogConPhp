<?php
    class validadorRegistro{
        private $nombre;
        private $email;

        private $errorNombre;
        private $errorEmail;
        private $errorClave1;
        private $errorClave2;

        public function __construct($pNombre, $email, $pClave1,$pClave2){
            $this->nombre="";
            $this->email="";

            $this->errorNombre =validarNombre(pNombre);
        }

        private function variableIniciada($variable){
            if(isset($varible) && !empty($variable)){
                return true;
            }else{
                return false;
            }
        }

        private function validarNombre($pNombre);{
            if(!variableIniciada($pNombre)){
                return "Debes escribir un nombre de usuario";
            }else{
                $this->nombre=$pNombre;
            }

            if(strlen($pNombre)<6){
                return "El nombre debe tener minimo 6 caracteres";
            }
            if(strlen($pNombre)>24){
                return "El nombre no debe ser mas largo de 24 caracteres";
            }

            return "";
        }
        
    }
?>