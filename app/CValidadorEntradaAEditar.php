<?php
include_once './app/CRepositorioEntrada.inc.php';
include_once './app/CValidador.php';

class CValidadorEntradaAEditar extends CValidador{
    private $cambiosRealizados;
    private $checkbox;

    private $tituloOriginal;
    private $urlOriginal;
    private $textoOriginal;
    private $checkboxOriginal;

    public function __construct($pTitulo,$pTituloOriginal,$pUrl,$pUrlOriginal,$pTexto,$pTextoOriginal,
        $pCheckbox,$pCheckboxOriginal,$pConexion)
    {
        $this->titulo = $this->getVariableIfIniciada($pTitulo);
        $this->url = $this->getVariableIfIniciada($pUrl);
        $this->texto = $this->getVariableIfIniciada($pTexto);
        $this->checkbox = $this->getVariableIfIniciada($pCheckbox);

        $this->tituloOriginal = $this->getVariableIfIniciada($pTituloOriginal);
        $this->urlOriginal = $this->getVariableIfIniciada($pUrlOriginal);
        $this->textoOriginal = $this->getVariableIfIniciada($pTextoOriginal);
        $this->checkboxOriginal = $this->getVariableIfIniciada($pCheckboxOriginal);

        if($this->titulo == $this->tituloOriginal && $this->url == $this->urlOriginal &&
            $this->texto == $this->textoOriginal && $this->checkbox == $this->checkboxOriginal){

            $this->cambiosRealizados =false;     

        }else{

            $this->cambiosRealizados =true;        

        }

        if($this->cambiosRealizados){
            echo 'hay cambios';
            $this->avisoInicio = '<br><div class="alert alert-danger" role="alert">';
            $this->avisoCierre = '</div>';

            if($this->titulo!== $this->tituloOriginal){
                $this->errorTitulo = $this->validarTitulo($pConexion,$this->titulo);
            }else{
                $this->errorTitulo ='';
            }

            if($this->url!== $this->urlOriginal){
                $this->errorUrl = $this->validarUrl($pConexion,$this->url);
            }else{
                $this->errorUrl ='';
            }

            if($this->texto!== $this->textoOriginal){
                $this->errorTexto = $this->validarTexto($this->texto);
            }else{
                $this->errorTexto ='';
            }
        }else{
            echo 'no hay cambios';
            
            //Redirigir
        }

    }

    private function getVariableIfIniciada($pVariable){
        if($this->variableIniciada($pVariable))
            return $pVariable;
        else
            return '';
    }

    public function hayCambios(){
        return $this->cambiosRealizados;
    }

    public function getTituloOriginal(){
        return $this-> tituloOriginal;
    }
    public function getUrlOriginal(){
        return $this-> urlOriginal;
    }
    public function getTextoOriginal(){
        return $this-> textoOriginal;
    }

    public function getCheckboxOriginal(){
        return $this-> checkboxOriginal;
    }

    public function getCheckbox(){
        return $this-> checkbox;
    }
}
