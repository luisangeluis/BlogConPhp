<?php
include_once 'app/Conexion.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';

$titulo = 'Recuperar Password';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';

?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <p> 
                Sigue las instrucciones para recuperar tu contraseña.
            </p>
            <p>
                Escribe la direccion de correo con la que te registraste y te enviaremos un email para restablecer tu contraseña

            </p>
        </div>
        <div class="col-lg-6">
            <form role="form" method="POST" action="<?php echo RUTA_GENERAR_URL_SECRETA?>">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Introduce tu email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required autofocus>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <button type="submit" class="btn btn-primary" name="enviar-email">Recuperar clave</button>
            </form>
        </div>
    </div>
</div>
<?php
include_once './plantillas/documento-cierre.inc.php';
?>