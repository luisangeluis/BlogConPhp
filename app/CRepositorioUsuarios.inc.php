<?php
class CRepositorioUsuarios
{

    public static function getAllUsers($pConexion)
    {

        $usuarios = array();

        if (isset($pConexion)) {

            try {
                include_once 'CUsuario.inc.php';

                $sql = 'SELECT * FROM usuarios';
                $sentencia = $pConexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {

                    foreach ($resultado as $fila) {
                        $usuarios[] = new CUsuario($fila['id'], $fila['nombre'], $fila['email'], $fila['password'], $fila['fecha_registro'], $fila['activo'],);
                    }
                }
            } catch (PDOException $e) {
                print 'ERROR' . $e->getMessage();
            }
        }

        return $usuarios;
    }

    public static function getNumUsers($pConexion)
    {

        $totalUsuarios = 0;

        if (isset($pConexion)) {
            try {
                $sql = 'SELECT COUNT(*) AS total FROM usuarios';

                $sentencia =  $pConexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                $totalUsuarios = $resultado['total'];
            } catch (PDOException $e) {
                print 'ERROR' . $e->getMessage();
            }
        }

        return $totalUsuarios;
    }

    //Insertar un usuario
    public static function InsertarUsuario($pConexion, $pUsuario)
    {

        $usuarioInsertado = false;

        if (isset($pConexion)) {
            try {
                $sql = 'INSERT INTO usuarios(nombre,email,password,fecha_registro,activo) VALUES(:nombre,:email,:pass,NOW(),0)';

                $sentencia = $pConexion->prepare($sql);

                $NOMBRE = $pUsuario->getNombre();
                $EMAIL = $pUsuario->getEmail();
                $PASSWORD = $pUsuario->getPassword();

                $sentencia->bindParam(':nombre', $NOMBRE, PDO::PARAM_STR);
                $sentencia->bindParam(':email', $EMAIL, PDO::PARAM_STR);
                $sentencia->bindParam(':pass', $PASSWORD, PDO::PARAM_STR);

                $usuarioInsertado = $sentencia->execute();
            } catch (PDOException $e) {
                print 'ERROR' . $e->getMessage();
            }
        }
        return $usuarioInsertado;
    }
    //Buscar usuario
    public static function nombreExiste($pConexion, $pNombre)
    {
        $nombreExiste = true;

        if (isset($pConexion)) {
            try {
                $sql = 'SELECT * FROM usuarios WHERE nombre=:nombre';
                $sentencia = $pConexion->prepare($sql);

                $sentencia->bindParam(':nombre', $pNombre, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $nombreExiste = true;
                } else {
                    $nombreExiste = false;
                }
            } catch (PDOException $e) {
                print 'ERROR' . $e->getMessage();
            }
        }

        return $nombreExiste;
    }

    public static function emailExiste($pConexion, $pEmail)
    {
        $emailExiste = false;
        if (isset($pConexion)) {
            try {

                $sql = 'SELECT * FROM usuarios where email=:email';
                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':email', $pEmail, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $emailExiste = true;
                } else {
                    $emailExiste = false;
                }
            } catch (PDOException $e) {
                print 'ERROR ' . $e->getMessage();
            }
        }

        return $emailExiste;
    }

    //Obtener usuario por email
    public static function getUserPorEmail($pConexion, $pEmail)
    {
        $usuario=null;

        if (isset($pConexion)) {
            try {
                include_once 'CUsuario.inc.php';

                $sql = 'SELECT * FROM usuarios WHERE email= :email';
                $sentencia = $pConexion->prepare($sql);
                
                $sentencia->bindParam(':email', $pEmail, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $usuario = new CUsuario(
                        $resultado['id'],
                        $resultado['nombre'],
                        $resultado['email'],
                        $resultado['password'],
                        $resultado['fecha_registro'],
                        $resultado['activo'],
                    );
                }
            } catch (PDOException $e) {
                print 'ERROR ' . $e->getMessage();
            }
        }

        return $usuario;
    }

    public static function GetUserById($pConexion,$pId){
        $usuario = null;
        if(isset($pConexion)){
            try{
                $sql = 'SELECT * FROM usuarios WHERE id = :id';
                $sentencia = $pConexion -> prepare($sql);

                $sentencia ->bindParam(':id',$pId,PDO::PARAM_STR);
                $sentencia -> execute();
                $resultado = $sentencia -> fetch();

                if(!empty($resultado)){
                    $usuario = new CUsuario(
                        $resultado['id'],
                        $resultado['nombre'],
                        $resultado['email'],
                        $resultado['password'],
                        $resultado['fecha_registro'],
                        $resultado['activo'],
                    );
                }

            }catch(PDOException $e){
                print 'ERROR ' . $e->getMessage();

            }
        }

        return $usuario;
    }

    public static function cambiarPassword($pConexion,$pPassword,$pId){
        $passwordCambiado = false;

        if(isset($pConexion)){
            try{
                $pConexion->beginTransaction();
                $sql = 'UPDATE usuarios SET password = :password WHERE id = :id';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':password',$pPassword,PDO::PARAM_STR);
                $sentencia->bindParam(':id',$pId,PDO::PARAM_STR);
                $sentencia -> execute();

                $resultado = $sentencia->rowCount();

                $sql2 = 'DELETE FROM recuperacion_password WHERE usuario_id=:pId';

                $sentencia = $pConexion->prepare($sql2);
                $sentencia ->bindParam('pId',$pId,PDO::PARAM_STR);
                $sentencia ->execute();

                $resultado2 = $sentencia->rowCount();

                if($resultado && $resultado2)
                    $passwordCambiado = true;
                $pConexion->commit();   
            }catch(PDOException $e){
                print 'ERROR: '. $e->getMessage();
                $pConexion -> rollBack();

            }
        }

        return $passwordCambiado;
    }
}
