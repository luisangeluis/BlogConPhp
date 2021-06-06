<?php

class CUsuario {
    private $id;
    private $nombre;
    private $email;
    private $password;
    private $fechaRegistro;
    private $activo;

    public function __construct($pId, $pNombre, $pEmail, $pPassword, $pFechaRegistro, $pActivo){
        $id =$pId;
        $nombre = $pNombre;
        $email = $pEmail;
        $password = $pPassword;
        $fechaRegistro = $pFechaRegistro;
        $activo = $pActivo;

    }
    //GETTERS Y SETTERS
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return $this->password;
    }
    public function getFechaRegistro(){
        return $this->fechaRegistro;
    }
    public function getActivo(){
        return $this->activo;
    }

    public function setNombre($pNombre){
        $nombre = $pNombre;
    }
    public function setEmail($pEmail){
        $email = $pEmail;
    }
    public function setPassword($pPassword){
        $password = $pPassword;
    }
    public function setActivo($pActivo){
        $activo = $pActivo;
    }
    


}