<?php
    class CComentario{
        private $id;
        private $autorId;
        private $entradaId;
        private $titulo;
        private $texto;
        private $fecha;

        public function __construct($pId,$pAutorId,$pEntrada, $pTitulo,$pTexto,$pFecha)
        {
            $this->id = $pId;
            $this->autorId = $pAutorId;
            $this->entradaId = $pEntrada;
            $this->titulo = $pTitulo;
            $this->texto = $pTexto;
            $this->fecha = $pFecha;


        }
        //Getters y Setters
        public function getId(){
            return $this->id;
        }
        public function getAutorId(){
            return $this->autorId;
        }
        public function getEntradaId(){
            return $this->entradaId;
        }
        public function getTitulo(){
            return $this->titulo;
        }
        public function getTexto(){
            return $this->texto;
        }
        public function getFecha(){
            return $this->fecha;
        }

        public function setTitulo($pTitulo){
            $this->autor = $pTitulo;
        }
        public function setTexto($pTexto){
            $this->autor = $pTexto;
        }
        





        
    }

 ?>   
