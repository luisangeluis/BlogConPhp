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

    public static function urlSecretaExiste($pConexion,$urlSecreta){
        $urlExiste = false;

        if(isset($pConexion)){
            try{
                $sql = 'SELECT * FROM recuperacion_password WHERE url_secreta=:urlSecreta';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':urlSecreta',$urlSecreta,PDO::PARAM_STR);   
                $sentencia -> execute();
                
                $resultado = $sentencia->fetch();
                if(count($resultado)){
                    $urlExiste = true;  
                }
            }catch(PDOException $e){
                print 'ERROR: '.$e->getMessage();
            }
        }

        return $urlExiste;
    }

    public static function getIdUsuarioByUrlSecreta($pConexion,$pUrlSecreta){
        $idUsuario = null;

        if(isset($pConexion)){
            try{
                include_once './app/CRecuperacionPassword.inc.php';

                $sql = 'SELECT * FROM recuperacion_password WHERE url_secreta=:urlSecreta';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':urlSecreta',$pUrlSecreta,PDO::PARAM_STR);   
                $sentencia -> execute();
                
                $resultado = $sentencia->fetch();
                if(!empty($resultado)){
                    $idUsuario = $resultado['usuario_id'];  
                }
            }catch(PDOException $e){
                print 'ERROR: '.$e->getMessage();
            }
        }

        return $idUsuario;
    }
}