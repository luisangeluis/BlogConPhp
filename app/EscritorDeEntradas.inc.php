<?php
include_once './app/CEntrada.inc.php';
include_once './app/CRepositorioEntrada.inc.php';

class EscritorioDeEntradas{

    public static function GetAllEntradas(){
        $entradas = CRepositorioEntrada::GetEntradasFechaDescendiente(Conexion::getConexion());

        if(count($entradas)){
            foreach($entradas as $entrada){
                self::escribirEntrada($entrada);
            }
        }

        return $entradas;
    } 

     public static function escribirEntrada($entrada){
         if(!isset($entrada)){
             return;
         }
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <?php echo $entrada -> getTitulo()?>
                    </div>
                    <div class="card-body">
                        <div class="card-title"><?php echo nl2br($entrada-> getFecha())?></div>
                        <div class="card-text">
                            <?php echo nl2br($entrada -> getTexto())?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        
        
     }   
}

?>