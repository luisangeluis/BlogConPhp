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
        //getters
        public function getTitulo(){
            return $this-> titulo;
        }

        public function getUrl(){
            return $this-> url;
        }

        public function getTexto(){
            return $this-> texto;
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
            if(!$this->variableIniciada($pUrl))
                return "Debes escribir una url";
            else
                $this->url = $pUrl;

            if(strlen($pUrl) > 255)
                return "El titulo no puede ser mayor a 255 caracteres";
            //Metodo trim() convierte una cadena  a una cadena sin espacios en blanco.
            if(strlen($pUrl) !== strlen( trim($pUrl) ) )
                return "La url no debe tener espacios en blanco.";
            
            if(CRepositorioEntrada::URLExiste($pConexion,$pUrl))
                return "Ya existe un articulo con esta url, elige una diferente";

        }

        private function validarTexto($pTexto){
            if(!$this->variableIniciada($pTexto))
                return "Debes escribir un texto";
            else
                $this->texto = $pTexto;
        }
        
        public function mostrarTituloEnPantalla(){
            if($this->titulo !== "")
                echo "value = '$this->titulo' ";
        }

        public function mostrarURLEnPantalla(){
            if($this->url !== "")
                echo "value = '$this->url' ";
        }

        public function mostrarTextoEnPantalla(){
            if($this->texto !== "" && strlen(trim($this->texto)) > 0 )
                echo $this->texto;
        }

        public function mostrarErrorTituloEnPantalla(){
            if($this->errorTitulo !=="")
                echo "$this->avisoInicio $this->errorTitulo $this->avisoCierre";
        }

        public function mostrarErrorUrlEnPantalla(){
            if($this->errorUrl !=="")
                echo "$this->avisoInicio $this->errorUrl $this->avisoCierre";
        }

        public function mostrarErrorTextoEnPantalla(){
            if($this->errorTexto !=="")
                echo "$this->avisoInicio $this->errorTexto $this->avisoCierre";
        }

        public function validarFormulario(){
            if($this->errorTitulo == "" && $this->errorUrl =="" && $this->errorTexto=="")
                return true;
            else
                return false;
        }
    }

?>