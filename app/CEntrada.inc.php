<?php

class CEntrada{
    private $id;
    private $autor_id;
    private $titulo;
    private $texto;
    private $fecha;
    private $activa;


    public function __construct($pId, $pAutor_id,$pTitulo,$pTexto,$pFecha,$pActiva){

        $this->id = $pId;
        $this->autor_id = $pAutor_id;
        $this->titulo = $pTitulo;
        $this->texto = $pTexto;
        $this->fecha = $pFecha;
        $this->activa = $pActiva;
    }

    //Getters y Setters

    public function getId(){
        return $this->id;
    }
    public function getAutor(){
        return $this->autor_id;
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
    public function getActiva(){
        return $this->activa;
    }


    public function setTitulo($pTitulo){
        $this->autor = $pTitulo;
    }
    public function setTexto($pTexto){
        $this->autor = $pTexto;
    }
    public function setActiva($pActiva){
        $this->activa = $pActiva;
    }
    

}
?>