<?php
include_once 'app/Conexion.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';

$titulo = 'Registro';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';
?>
<div class="container ">
    <div class="jumbotron d-flex">
        <!-- <h1 class="align-self-center">Formulario de Registro</h1> -->
        <h1 class="text-center align-self-center mx-auto">FORMULARIO DE REGISTRO</h1>

    </div>
</div>

<div class="container">
    <div class="row">
        <!--Inicio de columnas para registrarte-->
        <div class="col-md-6 mt-5">
            <div class="card text-center">
                <div class="card-header">
                    Instrucciones
                </div>
                <div class="card-body text-wrap">
                    <h5 class="card-title">Bienvenido al registro.</h5>
                    <p class="card-text">Para Unirte al blog ingresa un usuario y una contraseña validas.Para Unirte al blog ingresa un usuario y una contraseña validas.Para Unirte al blog ingresa un usuario y una contraseña validas.</p>
                    <p>Te recordamos que uses una contraseña fuerte</p>
                </div>
                <div class="card-footer text-muted">
                    <a href="#">¿Ya tienes una cuenta?</a>
                    <a href="#">¿Olvidaste tu contraseña?</a><br>

                </div>
            </div>
        </div>
        <div class="col-md-6 mt-5">
            <div class="card text-center">
                <div class="card-header">
                    Introduce tus datos
                </div>
                <div class="card-body text-wrap">
                    <form role="form" method="POST" action="registro_action.php">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Nombre de Usuario</span>
                            <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1" name="nombre">

                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Email</span>
                            <input type="email" class="form-control" placeholder="Email" aria-label="Username" aria-describedby="basic-addon1" name="email">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Password</span>
                            <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password1">
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Repite el Password</span>
                            <input type="password" class="form-control" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password2">
                        </div>
                            <button type="submit" class="btn btn-primary" name="enviar">Enviar Datos</button>
                            <button type="reset" class="btn btn-primary" name="limpiar">Limpiar Formulario</button>

                    </form>

                </div>
                <div class="card-footer text-muted">


                </div>
            </div>
        </div>
    </div>

</div>

<?php
include_once './plantillas/documento-cierre.inc.php';
?>