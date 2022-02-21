<?php
class CValidadorCambiarPassword
{

    private $avisoInicio;
    private $avisoCierre;

    private $password1;

    private $errorPassword1;
    private $errorPassword2;

    public function __construct($pPassword1, $pPassword2)
    {
        $this->avisoInicio = '<br><div class="alert alert-danger" role="alert">';
        $this->avisoCierre = '</div>';

        $this->password1 = '';
        $this->password2 = '';

        $this->errorPassword1 = $this->validarPassword1($pPassword1);
        $this->errorPassword2 = $this->validarPassword2($pPassword1,$pPassword2);

        if($this->errorPassword1==='' && $this->errorPassword2==='')
            $this->password1 = $pPassword1;
    }

    public function getPassword(){
        return $this->password1;
    }
    public function getErrorPassword1()
    {
        return $this->errorPassword1;
    }

    public function getErrorPassword2()
    {
        return $this->errorPassword2;
    }

    private function variableIniciada($pVariable)
    {
        if (isset($pVariable) && !empty($pVariable))
            return true;
        else
            return false;
    }

    private function validarPassword1($pPassword)
    {
        if (!$this->variableIniciada($pPassword))
            return 'debes escribir el password 1';

        return '';
    }

    private function validarPassword2($pPassword1, $pPassword2)
    {
        if (!$this->variableIniciada($pPassword1))
            return 'debes escribir el password 1';

        if ($pPassword1 !== $pPassword2)
            return 'Los password deben coincidir';

        if (!$this->variableIniciada($pPassword2))
            return 'debes repetir el password 2';

        return '';
    }

    public function mostrarErrorPasswor1()
    {
        if ($this->errorPasswor1 !== '') {
            echo $this-> avisoInicio . $this->errorPassword1 . $this->avisoCierre;
         }
    }

    public function mostrarErrorPasswor2()
    {
        if($this->errorPassword2!==''){
            echo $this-> avisoInicio . $this->errorPassword2 . $this->avisoCierre;

        }
    }

    public function formValidado(){
        if($this->errorPassword1 ==='' && $this->errorPassword2===''){
            echo 'retorne true';
            return true;

        }
        else
            return false;
    }
}
