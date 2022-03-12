<?php
class CValidadorBuscadorAvanzado extends CValidadorBuscador
{


    private $arrayCampos;
    private $fecha;

    public function __construct($pArrayCampos, $pFecha, $pTermino)
    {
        parent::__construct($pTermino);

        if ($this->variableIniciada($pArrayCampos)) {
            $this->arrayCampos = $pArrayCampos;
        }

        if ($this->variableIniciada($pFecha)) {
            $this->fecha = $pFecha;
        }
    }


    public function getArrayCampos(){
        return $this->arrayCampos;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function isFormValido(){
        if($this->terminoCorrecto() && $this->getArrayCampos()!=null && $this->getFecha()!=null){
            return true;
        }

        return false;
    }

    //validar que haya cuando menos un array y si no asignar uno
}
