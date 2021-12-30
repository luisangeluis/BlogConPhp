<?php
include_once 'app/Conexion.inc.php';
include_once 'app/CEntrada.inc.php';
include_once 'app/config.inc.php';

class CRepositorioEntrada
{
    public static function insertarEntrada($pConexion, $pEntrada)
    {
        $entradaInsertada = false;

        if (isset($pConexion)) {
            try {
                $sql = 'INSERT INTO entradas(autor_id,url,titulo,texto,fecha,activa) VALUES(:autor_id,:url,:titulo,:texto,NOW(),0)';

                $sentencia = $pConexion->prepare($sql);

                $AUTOR_ID = $pEntrada->getAutor();
                $URL = $pEntrada->getUrl();
                $TITULO = $pEntrada->getTitulo();
                $TEXTO = $pEntrada->getTexto();

                $sentencia->bindparam(':autor_id', $AUTOR_ID, PDO::PARAM_STR);
                $sentencia->bindparam(':url', $URL, PDO::PARAM_STR);
                $sentencia->bindparam(':titulo', $TITULO, PDO::PARAM_STR);
                $sentencia->bindparam(':texto', $TEXTO, PDO::PARAM_STR);

                $entradaInsertada = $sentencia->execute();
            } catch (PDOException $e) {
                print 'ERROR: '. $e->getMessage();
            }
        }
        return $entradaInsertada;
    }

    public static function GetEntradasFechaDescendiente($pConexion){
        $entradas=[];
        
        if(isset($pConexion)){
            try{
                $sql ='SELECT * FROM entradas ORDER BY fecha DESC LIMIT 5';
                
                $sentencia = $pConexion->prepare($sql);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();
                if(count($resultado)){
                    foreach($resultado as $fila){
                        $entradas[] = new CEntrada($fila['id'],$fila['autor_id'],$fila['url'],$fila['titulo'],$fila['texto'],
                                        $fila['fecha'],$fila['activa']);
                        
                    }

                }
                }catch(PDOException $e){
                print 'ERROR: '. $e->getMessage();
 
            }

        }
        return $entradas;

    }

    public static function getEntradaByUrl($pConexion,$pUrl){
        $entrada = null;
        if(isset($pConexion)){
            try{
                $sql = 'SELECT * FROM entradas WHERE url LIKE :url'; 

                $sentencia = $pConexion->prepare($sql);

                $sentencia->bindparam(':url', $pUrl, PDO::PARAM_STR);
                $sentencia -> execute(); 
                $resultado = $sentencia->fetch();

                if(!empty($resultado)){
                    $entrada = new CEntrada($resultado['id'],$resultado['autor_id'],$resultado['url'],$resultado['titulo'],
                        $resultado['texto'],$resultado['fecha'],$resultado['activa']);
                }
            }catch(PDOException $e){
                print 'ERROR: '. $e->getMessage();
            }
        }
        return $entrada;
    }

    // public static function getEntradasAzar($pConexion,$pLimit){
    //     $entradas = [];

    //     if(isset($pConexion)){
    //         try{
    //             $sql = 'SELECT * FROM entradas ORDER BY id DESC LIMIT :pLimit';
    //             $sentencia = $pConexion->prepare($sql);

    //             $sentencia ->bindparam(':pLimit', $pLimit,PDO::PARAM_STR);
    //             $sentencia -> execute();
    //             $resultado = $sentencia -> fetchAll();

    //             if(count($resultado)){
    //                 foreach($resultado as $entrada){
    //                     $entradas[] = new CEntrada($entrada['id'],$entrada['autor_id'],$entrada['url'],$entrada['titulo'],$entrada['texto'],
    //                     $entrada['fecha'],$entrada['activa']);
    //                 }
    //             }
    //         }catch(PDOException $e){
    //             print 'ERROR: '. $e->getMessage();

    //         }
    //     }
        
    //     return $entradas;
    // }
    
    public static function getEntradasAzar($pConexion,$pLimit){
        $entradas=[];

        if(isset($pConexion)){
            try{
                include_once './app/CUsuario.inc.php';

                $sql = "SELECT * FROM entradas ORDER BY RAND() LIMIT $pLimit";

                $sentencia = $pConexion -> prepare($sql);
                $sentencia ->execute();

                $resultado = $sentencia -> fetchAll();

                if(count($resultado)){
                    foreach($resultado as $entrada){
                        $entradas[] = new CEntrada($entrada['id'],$entrada['autor_id'],$entrada['url'],$entrada['titulo'],$entrada['texto'],
                        $entrada['fecha'],$entrada['activa']);
                    }
                }
            }catch(PDOException $e){
                print 'ERROR: '. $e->getMessage();

            }
        }
        return $entradas;
    }

    public static function getEntradasAzarByAutor($pConexion,$pUsuario,$pLimit){
        $entradas = [];
        if(isset($pConexion)){
            try{

                $idUsuario = $pUsuario -> getId();
                $sql = "SELECT * FROM entradas WHERE autor_id = $idUsuario ORDER BY id ASC LIMIT $pLimit";
                $sentencia = $pConexion->prepare($sql);
                $sentencia -> execute();
                $resultado = $sentencia -> fetchAll();

                if(count($resultado)){
                    foreach($resultado as $entrada){
                        $entradas[] = new CEntrada($entrada['id'],$entrada['autor_id'],$entrada['url'],$entrada['titulo'],$entrada['texto'],
                        $entrada['fecha'],$entrada['activa']);
                    } 
                }
            }catch(PDOException $e){
                print 'ERROR: '. $e->getMessage();

            }
        }
        return $entradas;
    }

    public static function getEntradasActivasUser($pConexion,$pIdUsuario){
        $entradasUser = 0;

        if(isset($pConexion)){
            try{
                $sql = 'SELECT COUNT(*) as totalEntradas FROM entradas where autor_id = :pIdUsuario AND activa = 1';
                
                $sentencia = $pConexion -> prepare($sql);
                $sentencia -> bindParam(':pIdUsuario',$pIdUsuario,PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia->fetch();

                if(!empty($resultado)){
                    $entradasUser = $resultado['totalEntradas'];
                }
                
            }catch(PDOException $e){
                print 'ERROR: '. $e->getMessage();
            }
        }
        return $entradasUser;
    }

    public static function getEntradasInactivasUser($pConexion,$pIdUsuario){
        $entradasUser = 0;

        if(isset($pConexion)){
            try{
                $sql = 'SELECT COUNT(*) as totalEntradas FROM entradas where autor_id = :pIdUsuario AND activa = 0';
                
                $sentencia = $pConexion -> prepare($sql);
                $sentencia -> bindParam(':pIdUsuario',$pIdUsuario,PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia->fetch();

                if(!empty($resultado)){
                    $entradasUser = $resultado['totalEntradas'];
                }
                
            }catch(PDOException $e){
                print 'ERROR: '. $e->getMessage();
            }
        }
        return $entradasUser;
    }
    
    public static function getEntradasUserFechaDescendente($pConexion,$idUsuario){
        $entradas = [];
        
        if(isset($pConexion)){
            try{
                $sql = 'SELECT e.id,e.autor_id,e.url,e.titulo,e.texto,e.fecha,e.activa, COUNT(c.id) as totalComentarios
                FROM entradas AS e
                LEFT JOIN comentarios AS c 
                ON e.id = c.entrada_id
                WHERE e.autor_id = :idUsuario
                GROUP BY e.id
                ORDER BY e.fecha DESC';

                $sentencia = $pConexion -> prepare($sql);
                $sentencia -> bindParam(':idUsuario',$idUsuario,PDO::PARAM_STR);
                $sentencia -> execute();

                $resultado = $sentencia -> fetchAll();

                if(count($resultado)){
                    foreach($resultado as $fila){
                        $entradas[]= array(
                            new CEntrada($fila['id'],$fila['autor_id'],$fila['url'],$fila['titulo'],$fila['texto'],$fila['fecha'],$fila['activa']
                            ),
                            $fila['totalComentarios']
                        );
                    }
                }

            }catch(PDOException $e){
                print 'ERROR: '.$e->getMessage();
            }
        }

        return $entradas;
    }

    public static function tituloExiste($pConexion,$pTitulo){
        
        $tituloExiste = null;
        $respuesta = null;
        if(isset($pConexion)){

            try{
                $sql = 'SELECT * FROM entradas WHERE titulo = :pTitulo';
                
                $sentencia = $pConexion -> prepare($sql);
                $sentencia -> bindParam(':pTitulo',$pTitulo,PDO::PARAM_STR);
                $sentencia ->execute();

                $resultado = $sentencia -> fetchAll();

                if(count($resultado)){
                    $tituloExiste = true;
                    $respuesta = count($resultado);
                }
                else{
                    $tituloExiste = false;
                    $respuesta = 0;
                }

            }catch(PDOException $e){
                print "ERROR". $e->getMessage();
            }
            
        }   
        return $tituloExiste;
    }

    public static function URLExiste($pConexion,$pUrl){
        $urlExiste = null;

        if(isset($pConexion)){
            try{
                $url = "SELECT COUNT(*) AS total FROM entradas WHERE url = :pUrl";

                $sentencia = $pConexion->prepare($url);
                $sentencia -> bindParam(':pUrl',$pUrl,PDO::PARAM_STR);
                $sentencia -> execute();

                $resultado = $sentencia-> fetch();

                if(count($resultado['total'])){
                    $urlExiste = true;

                }
                else{
                    $urlExiste = false;
                }


            }catch(PDOException $e){
                print "ERROR ".$e->getMessage();
            }
        }

        return $urlExiste;
    }
}
