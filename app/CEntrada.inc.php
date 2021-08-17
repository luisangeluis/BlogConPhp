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

    
}
?>