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
                $sql = 'INSERT INTO entradas(autor_id,titulo,texto,fecha,activa) VALUES(:autor_id,:titulo,:texto,NOW(),0)';

                $sentencia = $pConexion->prepare($sql);

                $AUTOR_ID = $pEntrada->getAutor();
                $TITULO = $pEntrada->getTitulo();
                $TEXTO = $pEntrada->getTexto();

                $sentencia->bindparam(':autor_id', $AUTOR_ID, PDO::PARAM_STR);
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
                        $entradas[] = new CEntrada($fila['id'],$fila['autor_id'],$fila['titulo'],$fila['texto'],$fila['fecha'],$fila['activa']);
                        
                        
                    }

                }
                }catch(PDOException $e){
                print 'ERROR: '. $e->getMessage();
 
            }

        }
        return $entradas;

    }
}
