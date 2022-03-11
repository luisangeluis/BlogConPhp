<?php
class CValidadorBuscador{
    private $termino;
    private $errorTermino;

    public function __construct($pTermino)
    {
        $this->errorTermino = $this->validarTermino($pTermino);
    }

    public function variableIniciada($pTermino){
        if(isset($pTermino) && !empty($pTermino))
            return true;
        else
            return false;
    }

    private function validarTermino($pTermino){

        $pTerminoTratado = str_replace(' ', '', $pTermino);
        $pTerminoTratado = preg_replace('/\s+/', '', $pTerminoTratado);

        if(!$this->variableIniciada($pTermino) || strlen($pTerminoTratado)==0){
            return 'Debes escribir el termino a buscar';
        }else{
            $this->termino = $pTermino;
        }

        return '';
    }

    public function terminoCorrecto(){
        if($this->errorTermino ==''){
            return true;
        }

        return false;
    }

    public function getTermino(){
        return $this->termino;
    }
}
?>