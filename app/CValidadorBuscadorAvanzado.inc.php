<?php
    class CValidadorBuscadorAvanzado extends CValidadorBuscador{

        private $titulo;
        private $contenido;
        private $tags;
        private $autor;

        private $antiguas;
        private $recientes;
        
        public function __construct($pTermino,$pTitulo,$pContenido,$pTags,$pAutor,$pAntiguas,$pRecientes)
        {
            parent::__construct($pTermino);
            
            $this->titulo = $this->validarTitulo($pTitulo);
            $this->contenido = $this->validarContenido($pContenido);
            $this->tags = $this->validarTags($pTags);
            $this->validarAutor = $this->validarAutor($pAutor);
            $this->antiguas = $this->validarAntiguas($pAntiguas);
            $this->recientes = $this->validarAntiguas($pRecientes);

        }

        private function validarTitulo($pTitulo){

            if(!$this->variableIniciada($pTitulo))
                return false;
            else   
                return true;
        }

        private function validarContenido($pContenido){
            if(!$this->variableIniciada($pContenido))
                return false;
            else   
                return true;
        }

        private function validarTags($pTags){
            if(!$this->variableIniciada($pTags))
                return false;
            else   
                return true;
        }

        private function validarAutor($pAutor){
            if(!$this->variableIniciada($pAutor))
                return false;
            else   
                return true;
        }

        private function validarAntiguas($pAntiguas){
            if(!$this->variableIniciada($pAntiguas))
            return false;
        else   
            return true;
        }
        private function validarRecientes($pRecientes){
            if(!$this->variableIniciada($pRecientes))
                return false;
            else   
                return true;
        }

        public function isCampoSeleccionado(){
            if($this->titulo || $this->contenido || $this->tags || $this->autor){
                return true;
            }else    
                return false;
            
        }

        public function isOrdenadoPor(){
            if($this->antiguas || $this->recientes){
                return true;
            }else if($this->antiguas && $this->recientes){
                return false;

            }else{
                return false;
            }

        }
        
        public function formValido(){
            if(($this->isCampoSeleccionado() && $this->isOrdenadoPor()) && $this->terminoCorrecto()){
                return true;
            }

            return false;
        }
    }
?>