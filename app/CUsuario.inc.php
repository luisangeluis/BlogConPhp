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
        return $id;
    }
    public function getNombre(){
        return $nombre;
    }
    public function getEmail(){
        return $email;
    }
    public function getPassword(){
        return $password;
    }
    public function getFechaRegistro(){
        return $fechaRegistro;
    }
    public function getActivo(){
        return $activo;
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