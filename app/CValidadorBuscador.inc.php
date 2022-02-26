<?php
class CValidadorBuscador{
    private $termino;
    private $errorTermino;

    public function __construct($pTermino)
    {
        
    }

    private function variableIniciada($pTermino){
        if(isset($pTermino) && !empty($pTermino))
            return true;
        else
            return false;
    }

    public function validarTermino($pTermino){

        $pTerminoTratado = str_replace(' ', '', $pTermino);
        $pTerminoTratado = preg_replace('/\s+/', '', $pTerminoTratado);

        if(!$this->variableIniciada($pTermino) || strlen($pTerminoTratado)==0){
            return 'Debes escribir el termino a buscar';
        }else{
            $this->termino = $pTermino;
        }

        return '';
    }
}
?>