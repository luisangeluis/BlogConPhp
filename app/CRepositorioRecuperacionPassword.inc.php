<?php

class CRepositorioRecuperacionPassword{

    public static function generarPeticion($pConexion,$pIdUsuario,$pUrlSecreta){
        $peticionGenerada = false;

        if(isset($pConexion)){
            try{
                $sql = 'INSERT INTO recuperacion_password(usuario_id,url_secreta,fecha) values(:pIdUsuario,:pUrlSecreta,NOW())';
                
                $sentencia = $pConexion->prepare($sql);
                $sentencia -> bindParam(':pIdUsuario',$pIdUsuario,PDO::PARAM_STR);
                $sentencia -> bindParam(':pUrlSecreta',$pUrlSecreta,PDO::PARAM_STR);
                
                $peticionGenerada = $sentencia -> execute();


            }catch(PDOException $e){
                print 'ERROR: ' . $e->getMessage();
            }
        }

        return $peticionGenerada;
    }
}