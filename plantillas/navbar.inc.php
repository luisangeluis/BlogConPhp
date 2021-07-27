<?php
include_once 'app/CControlSesion.inc.php';
Conexion::openConexion();

//$usuarios = CRepositorioUsuarios :: getAllUsers(Conexion::getConexion());
$totalUsuarios =   CRepositorioUsuarios::getNumUsers(Conexion::getConexion());
// echo $totalUsuarios;
Conexion::closeConexion();
?>
<nav class="navbar navbar-expand-md bg-secondary ">
  <div class="container">
    <a class="navbar-brand" href="#">BLOG LUIS-3</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="visually-hidden">Boton para barra de navegacion</span>
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <!--Navegacion del lado izquierdo-->
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="#">Entradas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Favoritos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Autores</a>
        </li>
      </ul>
      <!--Navegacion del lado derecho-->
      <ul class="navbar-nav ml-auto mb-2 mb-md-0 ">
        <?php
        if (CControlSesion::sesionIniciada()) {
        ?>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">
              <i class="fas fa-user-friends"></i>
              <!--Usuarios Registrados-->
              <?php echo ' ' . $_SESSION['nombreUsuario'] ?>
            </a>
          </li>
          <li class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-clock"></i> Gestor
            </button>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#">Entradas</a></li>
              <li><a class="dropdown-item" href="#">Comentarios</a></li>
              <li><a class="dropdown-item" href="#">Usuarios</a></li>
              <li><a class="dropdown-item" href="#">Favoritos</a></li>

            </ul>
          </li>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">
              <i class="fas fa-user-times"></i>

              Cerrar Sesion
            </a>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">
              <i class="fas fa-user-friends"></i>
              <!--Usuarios Registrados-->
              <?php
              echo $totalUsuarios;
              ?>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?php echo RUTA_LOGIN ?>"><span><i class="fas fa-sign-in-alt"></i></span>Iniciar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registro.php"><i class="fas fa-plus"></i>Registro</a>
          </li>
        <?php
        }
        ?>


      </ul>

    </div>
  </div>
</nav>