<?php
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';
include_once 'app/CValidadorLogin.inc.php';
include_once 'app/CControlSesion.inc.php';
include_once 'app/Redireccion.inc.php';

if(CControlSesion:: sesionIniciada()){
    Redireccion::Redirigir(SERVIDOR);
    echo 'hola';
}
if (isset($_POST['login'])) {

    Conexion::openConexion();

    $validador = new CValidadorLogin($_POST['email'], $_POST['password'], Conexion::getConexion());

    if ($validador->getError() === "" && !is_null($validador->getUsuario())) {

        CControlSesion:: openSession($validador->getUsuario()->getId(),$validador->getUsuario()->getNombre());

        Redireccion:: Redirigir(SERVIDOR);
        //iniciar sesion
        //redirigir a index
        
    }
    
    Conexion::closeConexion();
}

$titulo = 'Pagina de login';

include_once 'plantillas/documento-declaracion.inc.php';
include_once 'plantillas/navbar.inc.php'
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-6">
            <div class="card text-center mt-3">
                <div class="card-header">
                    Introduce tus datos
                </div>
                <div class="card-body text-wrap">
                    <form role="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <!-- <span class="input-group-text" id="email">Email</span> -->

                            <input type="email" name="email" class="form-control" id="email" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1" required autofocus
                            <?php
                                if(isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])){
                                    echo 'value="'. $_POST['email']. '"';
                                }
                            ?>
                            > 
                            
                        </div>
                        <div class=" mb-3">
                            <label for="" class="form-label">Password</label>
                            <!-- <span class="input-group-text" id="password">Password</span> -->
                            <input type="password" name="password" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" required>
                            <?php
                                if(isset($_POST['login'])){
                                    $validador->getError();
                                }
                            ?>    
                        </div>
                        <button type="submit" class="btn btn-primary" name="login">Iniciar Sesión</button>


                    </form>

                </div>
                <div class="card-footer text-muted">
                    <a href="#">¿Olvidaste tu password?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once 'plantillas/documento-cierre.inc.php'
?>