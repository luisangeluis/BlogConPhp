<?php
class CValidadorBuscador{
    private $termino;
    private $errorTermino;

    private $avisoInicio;
    private $avisoCierre;

    public function __construct($pTermino)
    {
        $this->avisoInicio = '<br><div class="alert alert-danger" role="alert">';
        $this->avisoCierre = '</div>';

        $this->errorTermino = $this->validarTermino($pTermino);
    }

    public function getTermino(){
        return $this->termino;
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

    public function mostrarTerminoEnPantalla(){
        echo "value = '$this->termino'";
    }

    public function mostrarErrorTermino(){
        if($this->errorTermino!=''){
            echo "$this->avisoInicio $this->errorTermino $this->avisoCierre";
        }
    }

    public function terminoCorrecto(){
        if($this->errorTermino ==''){
            return true;
        }

        return false;
    }

    
}
?>