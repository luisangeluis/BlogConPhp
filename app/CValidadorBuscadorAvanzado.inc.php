<?php
class CValidadorBuscadorAvanzado extends CValidadorBuscador
{

    private $hayCampos;
    private $hayFecha;
    private $arrayCampos = [];
    private $fecha = '';

    public function __construct($pTermino, $pArrayCampos, $pFecha)
    {
        parent::__construct($pTermino);

        $this->hayCampos = $this->validarCampos($pArrayCampos);
        $this->hayFecha=$this->validarFecha($pFecha);
    }

    public function getArrayCampos(){
        return $this->arrayCampos;

    }

    public function getFecha(){
        return $this->fecha;
    }

    private function validarCampos($pArrayCampos)
    {
        if (count($pArrayCampos)) {
            $this->arrayCampos = $pArrayCampos;

            return true;
        }else{
            
            return false;

        }

    }

    private function validarFecha($pFecha)
    {
        if ($pFecha != ''){
            $this->fecha = $pFecha;
            return true;
        }else{
            return false;

        }
    }

    public function isFormValido(){
        if($this->hayCampos && $this->hayFecha && $this->terminoCorrecto()){
            return true;
        }

        return false;
    }
}
