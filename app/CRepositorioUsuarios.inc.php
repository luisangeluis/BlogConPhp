<?php
class CRepositorioUsuarios{

    public static function getAllUsers($pConexion){

        $usuarios = array();

        if(isset($pConexion)){

            try{
                include_once 'CUsuario.inc.php';

                $sql = 'SELECT * FROM usuarios';
                $sentencia = $pConexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();

                if(count($resultado)){

                    foreach($resultado as $fila){
                        $usuarios[] = new CUsuario($fila['id'],$fila['nombre'],$fila['email'],$fila['password'],$fila['fecha_registro'],$fila['activo'],);


                    }
                }

            }catch(PDOException $e){
                print 'ERROR' . $e->getMessage();
            }
        }
        
        return $usuarios;
    }

    public static function getNumUsers($pConexion){

        $totalUsuarios =0;

        if(isset($pConexion)){
            try{
                $sql = 'SELECT COUNT(*) AS total FROM usuarios';

                $sentencia =  $pConexion -> prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();

                $totalUsuarios = $resultado['total'];
            }catch(PDOException $e){
                print 'ERROR' . $e->getMessage();
            }
        }

        return $totalUsuarios;
    }

    //Insertar usuario
    public static function InsertarUsuario($pConexion, $pUsuario){

        $usuarioInsertado=false;

        if(isset($pConexion)){
            try{
                $sql = 'INSERT INTO usuarios(nombre,email,password,fecha_registro,activo) VALUES(:nombre,:email,:password,NOW(),0)';
                $sentencia = $pConexion->prepare($sql);

                $sentencia ->bindParam(':nombre',$pUsuario ->getNombre(), PDO::PARAM_STR);
                $sentencia ->bindParam(':email',$pUsuario ->getEmail(), PDO::PARAM_STR);
                $sentencia ->bindParam(':password',$pUsuario ->getPassword(), PDO::PARAM_STR);

                $usuarioInsertado = $sentencia->execute();
            }catch(PDOException $e){
                print 'ERROR' . $e->getMessage();

            }
        }
    }
}