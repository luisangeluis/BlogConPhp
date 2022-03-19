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
                $sql = 'INSERT INTO entradas(autor_id,url,titulo,texto,fecha,activa) VALUES(:autor_id,:urrl,:titulo,:texto,NOW(),:activa)';

                $activa = 0;

                if($pEntrada -> estaActiva())
                    $activa =1;
                
                $sentencia = $pConexion->prepare($sql);

                $AUTOR_ID = $pEntrada->getAutor();
                $URL = $pEntrada->getUrl();
                $TITULO = $pEntrada->getTitulo();
                $TEXTO = $pEntrada->getTexto();
                // $ACTIVA = $pEntrada->getActiva();

                $sentencia->bindParam(':autor_id', $AUTOR_ID, PDO::PARAM_STR);
                $sentencia->bindParam(':urrl', $URL, PDO::PARAM_STR);
                $sentencia->bindParam(':titulo', $TITULO, PDO::PARAM_STR);
                $sentencia->bindParam(':texto', $TEXTO, PDO::PARAM_STR);
                $sentencia->bindParam(':activa', $activa, PDO::PARAM_STR);


                $entradaInsertada = $sentencia->execute();
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
            }
        }
        return $entradaInsertada;
    }

    public static function GetEntradasFechaDescendiente($pConexion)
    {
        $entradas = [];

        if (isset($pConexion)) {
            try {
                $sql = 'SELECT * FROM entradas ORDER BY fecha DESC LIMIT 5';

                $sentencia = $pConexion->prepare($sql);

                $sentencia->execute();

                $resultado = $sentencia->fetchAll();
                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = new CEntrada(
                            $fila['id'],
                            $fila['autor_id'],
                            $fila['url'],
                            $fila['titulo'],
                            $fila['texto'],
                            $fila['fecha'],
                            $fila['activa']
                        );
                    }
                }
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
            }
        }
        return $entradas;
    }

    public static function getEntradaByUrl($pConexion, $pUrl)
    {
        $entrada = null;
        if (isset($pConexion)) {
            try {
                $sql = 'SELECT * FROM entradas WHERE url LIKE :url';

                $sentencia = $pConexion->prepare($sql);

                $sentencia->bindparam(':url', $pUrl, PDO::PARAM_STR);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $entrada = new CEntrada(
                        $resultado['id'],
                        $resultado['autor_id'],
                        $resultado['url'],
                        $resultado['titulo'],
                        $resultado['texto'],
                        $resultado['fecha'],
                        $resultado['activa']
                    );
                }
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
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

    public static function getEntradasAzar($pConexion, $pLimit)
    {
        $entradas = [];

        if (isset($pConexion)) {
            try {
                include_once './app/CUsuario.inc.php';

                $sql = "SELECT * FROM entradas ORDER BY RAND() LIMIT $pLimit";

                $sentencia = $pConexion->prepare($sql);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $entrada) {
                        $entradas[] = new CEntrada(
                            $entrada['id'],
                            $entrada['autor_id'],
                            $entrada['url'],
                            $entrada['titulo'],
                            $entrada['texto'],
                            $entrada['fecha'],
                            $entrada['activa']
                        );
                    }
                }
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
            }
        }
        return $entradas;
    }

    public static function getEntradasAzarByAutor($pConexion, $pUsuario, $pLimit)
    {
        $entradas = [];
        if (isset($pConexion)) {
            try {

                $idUsuario = $pUsuario->getId();
                $sql = "SELECT * FROM entradas WHERE autor_id = $idUsuario ORDER BY id ASC LIMIT $pLimit";
                $sentencia = $pConexion->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $entrada) {
                        $entradas[] = new CEntrada(
                            $entrada['id'],
                            $entrada['autor_id'],
                            $entrada['url'],
                            $entrada['titulo'],
                            $entrada['texto'],
                            $entrada['fecha'],
                            $entrada['activa']
                        );
                    }
                }
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
            }
        }
        return $entradas;
    }

    public static function getEntradasActivasUser($pConexion, $pIdUsuario)
    {
        $entradasUser = 0;

        if (isset($pConexion)) {
            try {
                $sql = 'SELECT COUNT(*) as totalEntradas FROM entradas where autor_id = :pIdUsuario AND activa = 1';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':pIdUsuario', $pIdUsuario, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $entradasUser = $resultado['totalEntradas'];
                }
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
            }
        }
        return $entradasUser;
    }

    public static function getEntradasInactivasUser($pConexion, $pIdUsuario)
    {
        $entradasUser = 0;

        if (isset($pConexion)) {
            try {
                $sql = 'SELECT COUNT(*) as totalEntradas FROM entradas where autor_id = :pIdUsuario AND activa = 0';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':pIdUsuario', $pIdUsuario, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if (!empty($resultado)) {
                    $entradasUser = $resultado['totalEntradas'];
                }
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
            }
        }
        return $entradasUser;
    }

    public static function getEntradasUserFechaDescendente($pConexion, $idUsuario)
    {
        $entradas = [];

        if (isset($pConexion)) {
            try {
                $sql = 'SELECT e.id,e.autor_id,e.url,e.titulo,e.texto,e.fecha,e.activa, COUNT(c.id) as totalComentarios
                FROM entradas AS e
                LEFT JOIN comentarios AS c 
                ON e.id = c.entrada_id
                WHERE e.autor_id = :idUsuario
                GROUP BY e.id
                ORDER BY e.fecha DESC';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':idUsuario', $idUsuario, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $fila) {
                        $entradas[] = array(
                            new CEntrada(
                                $fila['id'],
                                $fila['autor_id'],
                                $fila['url'],
                                $fila['titulo'],
                                $fila['texto'],
                                $fila['fecha'],
                                $fila['activa']
                            ),
                            $fila['totalComentarios']
                        );
                    }
                }
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
            }
        }

        return $entradas;
    }

    public static function tituloExiste($pConexion, $pTitulo)
    {

        $tituloExiste = null;
        if (isset($pConexion)) {

            try {
                $sql = 'SELECT * FROM entradas WHERE titulo = :pTitulo';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':pTitulo', $pTitulo, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    $tituloExiste = true;
                } else {
                    $tituloExiste = false;
                }
            } catch (PDOException $e) {
                print "ERROR" . $e->getMessage();
            }
        }
        return $tituloExiste;
    }

    public static function URLExiste($pConexion, $pUrl)
    {
        $urlExiste = null;

        if (isset($pConexion)) {
            try {
                $sql = "SELECT COUNT(*) AS total FROM entradas WHERE url = :pUrl";

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':pUrl', $pUrl, PDO::PARAM_STR);
                $sentencia->execute();

                $resultado = $sentencia->fetch();

                if ($resultado['total']) {
                    $urlExiste = true;
                } else {
                    $urlExiste = false;
                }
            } catch (PDOException $e) {
                print "ERROR " . $e->getMessage();
            }
        }

        return $urlExiste;
    }

    public static function borrarEntradaYComentarios($pConexion, $pIdEntrada)
    {
        if (isset($pConexion)) {
            try {
                //beginTransaction() y commit() sirve para indicar que todas las operaciones entre este bloque
                //se tienen que hacer, se guardan en un registro secundario en el server para asegurarse de que asi
                //suceda.
                $pConexion -> beginTransaction();

                $sql1 = "DELETE FROM comentarios WHERE entrada_id = :idEntrada";
                $sentencia = $pConexion -> prepare($sql1);
                $sentencia -> bindParam(':idEntrada',$pIdEntrada,PDO::PARAM_STR);
                $sentencia -> execute();

                $sql2 = "DELETE FROM entradas WHERE id = :idEntrada";
                $sentencia = $pConexion -> prepare($sql2);
                $sentencia -> bindParam(':idEntrada',$pIdEntrada,PDO::PARAM_STR);
                $sentencia -> execute();
                
                $pConexion ->commit();
            } catch (PDOException $e) {
                print 'ERROR: ' . $e->getMessage();
                //Si hubo algun error con la transaccion todo regresa a su estado anterior.
                $pConexion -> rollBack();
            }
        }
    }

    public static function getEntradaById($pConexion,$pIdEntrada){
        $entrada = null;

        if(isset($pConexion)){

            try{
                $sql = 'SELECT * FROM entradas WHERE id = :pIdEntrada';

                $sentencia = $pConexion -> prepare($sql);
                $sentencia -> bindParam(':pIdEntrada',$pIdEntrada,PDO::PARAM_STR);
                $sentencia -> execute();
                
                $resultado = $sentencia->fetch();

                if(!empty($resultado)){
                    $entrada = new CEntrada(
                        $resultado['id'],
                        $resultado['autor_id'],
                        $resultado['url'],
                        $resultado['titulo'],
                        $resultado['texto'],
                        $resultado['fecha'],
                        $resultado['activa']
                    );
                }
                
            }catch(PDOException $e){
                print 'ERROR: '. $e -> getMessage();
            }

        }
        return $entrada;
    }

    public static function updateEntrada($pConexion,$pId,$pTitulo,$pUrl,$pTexto,$pActiva){
        $entradaActualizada = false;
        if(isset($pConexion)){

            try{
                $sql='UPDATE entradas SET titulo=:titulo,url=:url,texto=:texto,activa=:activa WHERE id = :id';

                $sentencia = $pConexion->prepare($sql);

                $sentencia ->bindParam(':id',$pId,PDO::PARAM_STR);
                $sentencia ->bindParam(':titulo',$pTitulo,PDO::PARAM_STR);
                $sentencia ->bindParam(':url',$pUrl,PDO::PARAM_STR);
                $sentencia ->bindParam(':texto',$pTexto,PDO::PARAM_STR);
                $sentencia ->bindParam(':activa',$pActiva,PDO::PARAM_STR);

                $sentencia -> execute();
                //rowCount devuelve el numero de filas que fueron afectadas por la sentencia sql
                $resultado = $sentencia->rowCount();

                if($resultado){
                    $entradaActualizada = true;  
                }

            }catch(PDOException $e){
                print 'Error: '. $e->getMessage();
            }
        }
        return $entradaActualizada;
    }

    public static function busquedaEntradaTodosLosCampos($pConexion,$pTerminoBusqueda){
        
        $entradas = [];
        $pTerminoBusqueda = '%'.$pTerminoBusqueda.'%';
        if(isset($pConexion)){
            try{
                $sql = 'SELECT * FROM entradas WHERE titulo LIKE :terminoBusqueda OR texto LIKE :terminoBusqueda ORDER BY
                    fecha DESC LIMIT 25';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':terminoBusqueda',$pTerminoBusqueda,PDO::PARAM_STR);
                $sentencia->execute();
                
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $entrada) {
                        $entradas[] = new CEntrada($entrada['id'],$entrada['autor_id'],$entrada['url'],$entrada['titulo'],
                            $entrada['texto'],$entrada['fecha'],$entrada['activa']);
                    }
                }

            }catch(PDOException $e){
                print 'ERROR: '.$e->getMessage();
            }
        }

        return $entradas;
        
    }

    public static function busquedaEntradaByTitulo($pConexion,$pTerminoBusqueda){
        
        $entradas = [];
        $pTerminoBusqueda = '%'.$pTerminoBusqueda.'%';
        if(isset($pConexion)){
            try{
                $sql = 'SELECT * FROM entradas WHERE titulo LIKE :terminoBusqueda ORDER BY
                    fecha DESC LIMIT 25';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':terminoBusqueda',$pTerminoBusqueda,PDO::PARAM_STR);
                $sentencia->execute();
                
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $entrada) {
                        $entradas[] = new CEntrada($entrada['id'],$entrada['autor_id'],$entrada['url'],$entrada['titulo'],
                            $entrada['texto'],$entrada['fecha'],$entrada['activa']);
                    }
                }

            }catch(PDOException $e){
                print 'ERROR: '.$e->getMessage();
            }
        }

        return $entradas;
        
    }

    public static function busquedaEntradaByTexto($pConexion,$pTerminoBusqueda){
        
        $entradas = [];
        $pTerminoBusqueda = '%'.$pTerminoBusqueda.'%';
        if(isset($pConexion)){
            try{
                $sql = 'SELECT * FROM entradas WHERE texto LIKE :terminoBusqueda ORDER BY
                    fecha DESC LIMIT 25';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':terminoBusqueda',$pTerminoBusqueda,PDO::PARAM_STR);
                $sentencia->execute();
                
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $entrada) {
                        $entradas[] = new CEntrada($entrada['id'],$entrada['autor_id'],$entrada['url'],$entrada['titulo'],
                            $entrada['texto'],$entrada['fecha'],$entrada['activa']);
                    }
                }

            }catch(PDOException $e){
                print 'ERROR: '.$e->getMessage();
            }
        }

        return $entradas;
        
    }

    public static function busquedaEntradaByAutor($pConexion,$pTerminoBusqueda){
        
        $entradas = [];
        $pTerminoBusqueda = '%'.$pTerminoBusqueda.'%';
        if(isset($pConexion)){
            try{
                $sql = 'SELECT * FROM entradas AS e 
                        JOIN usuarios AS u 
                        ON u.id = e.autor_id 
                        WHERE u.nombre like :terminoBusqueda
                        ORDER BY e.fecha DESC
                        LIMIT 25';

                $sentencia = $pConexion->prepare($sql);
                $sentencia->bindParam(':terminoBusqueda',$pTerminoBusqueda,PDO::PARAM_STR);
                $sentencia->execute();
                
                $resultado = $sentencia->fetchAll();

                if (count($resultado)) {
                    foreach ($resultado as $entrada) {
                        $entradas[] = new CEntrada($entrada['id'],$entrada['autor_id'],$entrada['url'],$entrada['titulo'],
                            $entrada['texto'],$entrada['fecha'],$entrada['activa']);
                    }
                }

            }catch(PDOException $e){
                print 'ERROR: '.$e->getMessage();
            }
        }

        return $entradas;
        
    }
}
