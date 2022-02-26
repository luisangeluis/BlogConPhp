<?php
    include_once './app/CRepositorioEntrada.inc.php';
    include_once './app/CValidador.php';

    class CValidadorEntrada extends CValidador{

        public function __construct($pTitulo,$pUrl,$pTexto,$pConexion){
            $this->avisoInicio = '<br><div class="alert alert-danger" role="alert">';
            $this->avisoCierre = '</div>';

            $this->titulo="";
            $this->url="";
            $this->texto=""; 

            $this->errorTitulo = $this->validarTitulo($pConexion, $pTitulo);
            $this->errorUrl = $this->validarUrl($pConexion, $pUrl);
            $this->errorTexto = $this->validarTexto($pTexto);
        }
        
    }

?>