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
}