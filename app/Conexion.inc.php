<?php
class Conexion{
    private static $conexion;

    public static function openConexion() {
        if(!isset(self::$conexion)){
            try{
                include_once 'Config.inc.php';
                //Objeto PDO para la base de datos
                self::$conexion = new PDO("mysql:host=$nombreServidor; dbname=$nombreBaseDatos",$nombreUsuario,$password);
                //Para que el objeto PDO lance una excepcion en caso de que algo falle
                self::$conexion -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //Para que en la conexion se usen utf-8
                self::$conexion -> exec("SET CHARACTER SET utf8");

                print "Conexion abierta <br>";
            }catch(PDOException $ex){
                //El punto se usa para concatenar
                print "ERROR: " . $ex -> getMessage() . "<br>";        
                //Termina la conexion
                die();
            }
        }
    }

    public static function closeConexion(){
        if(isset(self::$conexion)){
            self::$conexion =null;
            
            print "Conexion cerrada";
        }

    }

    public static function getConexion(){
        return self::$Conexion;
    }

}