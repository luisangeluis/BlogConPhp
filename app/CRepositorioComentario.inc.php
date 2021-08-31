<?php
include_once 'app/Conexion.inc.php';
include_once 'app/CComentario.inc.php';
include_once 'app/config.inc.php';

class CRepositorioComentario
{
    public static function insertarComentario($pConexion, $pComentario)
    {
        $comentarioInsertado = false;

        if (isset($pConexion)) {
            try {
                $sql = 'INSERT INTO comentarios(autor_id,entrada_id,titulo,texto,fecha) 
                    VALUES(:autor_id,entrada_id,:titulo,:texto,NOW())';

                $sentencia = $pConexion->prepare($sql);

                $AUTOR_ID = $pComentario->getAutor();
                $ENTRADA_ID =$pComentario ->getEntradaId();
                $TITULO = $pComentario->getTitulo();
                $TEXTO = $pComentario->getTexto();

                $sentencia->bindparam(':autor_id', $AUTOR_ID, PDO::PARAM_STR);
                $sentencia->bindparam(':entrada_id', $ENTRADA_ID, PDO::PARAM_STR);
                $sentencia->bindparam(':titulo', $TITULO, PDO::PARAM_STR);
                $sentencia->bindparam(':texto', $TEXTO, PDO::PARAM_STR);

                $comentarioInsertado = $sentencia->execute();
            } catch (PDOException $e) {
                print 'ERROR: '. $e->getMessage();
            }
        }
        return $comentarioInsertado;
    }
}
