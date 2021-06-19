<?php
include_once 'app/CRepositorioUsuarios.inc.php';
class validadorRegistro
{
    //Varibles para crear un aviso en pantalla
    private $avisoInicio;
    private $avisoCierre;

    private $nombre;
    private $email;
    private $password;

    private $errorNombre;
    private $errorEmail;
    private $errorClave1;
    private $errorClave2;

    public function __construct($pNombre, $pEmail, $pClave1, $pClave2)
    {

        $this->avisoInicio = '<br><div class="alert alert-danger" role="alert">';
        $this->avisoCierre = '</div>';

        $this->nombre = "";
        $this->email = "";
        $this->password ="";

        $this->errorNombre = $this->validarNombre($pNombre);
        $this->errorEmail = $this->ValidarEmail($pEmail);
        $this->errorClave1 = $this->validarClave1($pClave1);
        $this->errorClave2 = $this->validarClave2($pClave1, $pClave2);

        if($this->errorClave1==="" && $this->errorClave2===""){
            $this->password = $pClave1;
        }
    }

    private function variableIniciada($variable)
    {
        if (isset($variable) && !empty($variable)) {
            return true;
        } else {
            return false;
        }
    }

    private function validarNombre($pNombre)
    {
        if (!$this->variableIniciada($pNombre)) {
            return "Debes escribir un nombre de usuario";
        } else {
            $this->nombre = $pNombre;
        }

        if (strlen($pNombre) < 6) {
            return "El nombre debe tener minimo 6 caracteres";
        }
        if (strlen($pNombre) > 24) {
            return "El nombre no debe ser mas largo de 24 caracteres";
        }

        if(CRepositorioUsuarios::nombreExiste(Conexion::getConexion(),$pNombre)){
            return "El nombre de usuario ya existe";
        }

        return "";
    }

    private function ValidarEmail($pEmail)
    {
        if (!$this->variableIniciada($pEmail)) {
            return "Debes escribir un email de usuario es panta";
        } else {
            $this->email = $pEmail;
        }
        if(CRepositorioUsuarios::emailExiste(Conexion::getConexion(),$pEmail)){
            return "El correo ya existe";

        }
        return "";
    }

    private function validarClave1($pClave1)
    {
        if (!$this->variableIniciada($pClave1)) {
            return "debes escribir una clave";
        }
        return "";
    }

    private function validarClave2($pClave1, $pClave2)
    {

        if (!$this->variableIniciada($pClave1)) {
            return "debes rellar primero la clave 1";
        }
        if ($pClave1 !== $pClave2) {
            return "debes repetir la contraseña correctamente";
        }
        if (!$this->variableIniciada($pClave2)) {
            return "Debes repetir la clave";
        }
        return "";
    }

    //getters y setters
    public function getNombre()
    {
        return $this->nombre;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getErrorNombre()
    {
        return $this->errorNombre;
    }
    public function getErrorEmail()
    {
        return $this->errorEmail;
    }
    public function getErrorClave1()
    {
        return $this->errorClave1;
    }
    public function getErrorClave2()
    {
        return $this->errorClave2;
    }
    //Lo muestra como atributo value
    public function mostrarNombreEnPantalla()
    {
        if ($this->nombre !== "") {
            echo 'value="' . $this->nombre . '"';
        }
    }


    //Lo muestra como atributo value
    public function mostrarEmailEnPantalla()
    {
        if ($this->email !== "") {
            echo 'value="' . $this->email . '"';
        }
    }

    //Lo muestra como mensaje imprimible
    public function mostrarErrorNombreEnPantalla()
    {
        if ($this->errorNombre !== "") {
            echo $this->avisoInicio . $this->errorNombre . $this->avisoCierre;
        }
    }
    //Lo muestra como mensaje imprimible
    public function mostrarErrorEmailEnPantalla()
    {
        if ($this->errorEmail !== "") {
            echo $this->avisoInicio . $this->errorEmail . $this->avisoCierre;
        }
    }
    //Lo muestra como mensaje imprimible
    public function mostrarErrorClave1EnPantalla()
    {
        if ($this->errorClave1 !== "") {
            echo $this->avisoInicio . $this->errorClave1 . $this->avisoCierre;
        }
    }
    //Lo muestra como mensaje imprimible
    public function mostrarErrorClave2EnPantalla()
    {
        if ($this->errorClave2 !== "") {
            echo $this->avisoInicio . $this->errorClave2 . $this->avisoCierre;
        }
    }

    public function validarFormulario()
    {
        if ($this->errorNombre === "" && $this->errorEmail === "" && $this->errorClave1 === "" && $this->errorClave2 === "") {
            return true;
        } else {
            return false;
        }
    }
}
