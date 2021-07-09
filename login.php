<?php
include_once 'app/Conexion.inc.php';
include_once 'app/config.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';

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

                            <input type="email" class="form-control" id="email"placeholder="Email" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <div class=" mb-3">
                            <label for="" class="form-label">Password</label>
                            <!-- <span class="input-group-text" id="password">Password</span> -->
                            <input type="password" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>

                        
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