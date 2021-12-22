<?php

    include_once './app/CRepositorioEntrada.inc.php';
    class CValidadorEntrada{

        private $titulo;
        private $url;
        private $texto;

        private $errorTitulo;
        private $errorUrl;
        private $errorTexto;
        
        private $avisoInicio;
        private $avisoCierre;
        public function __construct($pTitulo,$pUrl,$pTexto,$pConexion){
            $this->avisoInicio = '<br><div class="alert alert-danger" role="alert">';
            $this->avisoCierre = '</div>';

            $this->titulo="";
            $this->url="";
            $this->texto="";

            $this->errorTitulo = $this->validarTitulo($pConexion, $pTitulo);
            $this->errorUrl = $this->validarUrl($pConexion, $pUrl);
            $this->errorTexto = $this->validarTexto($pTexto);
        }

        private function variableIniciada($pVariable){
            if(isset($pVariable) && !empty($pVariable)) 
                return true;
            else 
                return false;
        }

        private function validarTitulo($pConexion, $pTitulo){
            if(!$this->variableIniciada($pTitulo))
                return "Debes escribir un titulo";
            else
                $this->titulo = $pTitulo;

            if(strlen($pTitulo) > 255)
                return "El titulo no puede ser mayor a 255 caracteres";

            if(CRepositorioEntrada::tituloExiste($pConexion,$pTitulo)){
                return "Ya existe una publicacion con este titulo, por favor elige uno diferente.";
            }

            return "";
        }
        private function validarUrl($pConexion, $pUrl){

        }
        private function validarTexto($pTexto){

        }
            
        
    }
?>