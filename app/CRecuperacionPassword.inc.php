<?php

class CRecuperacionPassword{

    private $id;
    private $usuarioId;
    private $urlSecreta;
    private $fecha;

    public function __construct($pId,$pUsuarioId,$pUrlSecreta,$pFecha)
    {
        $this->id = $pId;
        $this->usuarioId = $pUsuarioId;
        $this->urlSecreta = $pUrlSecreta;
        $this->fecha = $pFecha;
    }
}