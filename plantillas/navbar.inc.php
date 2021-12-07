<?php
include_once 'app/CControlSesion.inc.php';
Conexion::openConexion();

//$usuarios = CRepositorioUsuarios :: getAllUsers(Conexion::getConexion());
$totalUsuarios =   CRepositorioUsuarios::getNumUsers(Conexion::getConexion());
// echo $totalUsuarios;
?>
<nav class="navbar navbar-expand-md bg-secondary ">
  <div class="container">
    <a class="navbar-brand" href="<?php echo SERVIDOR ?>">BLOG LUIS-3</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="visually-hidden">Boton para barra de navegacion</span>
      <!-- <span class="navbar-toggler-icon"></span> -->
      <i class="fas fa-sliders-h" style="color:whitesmoke"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <?php
        if(!CControlSesion::sesionIniciada()){
      ?>
      <!--Navegacion del lado izquierdo-->
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item active">
          <a class="nav-link" aria-current="page" href="#"><i class="far fa-sticky-note"></i> Entradas</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-heart"></i>Favoritos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><i class="fas fa-user-edit"></i>Autores</a>
        </li>
      </ul>
      <?php
        }
      ?>
      <!--Navegacion del lado derecho-->
      <ul class="navbar-nav ml-auto margin-left mb-2 mb-md-0 ">
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
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?php echo RUTA_GESTOR?>">
            <i class="far fa-clock"></i>              
              Gestor
            </a>
          </li>
          
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?php echo  RUTA_LOGOUT?>">
              <i class="fas fa-user-times"></i>
              Cerrar Sesion
            </a>
          </li>
        <?php
        } else {
        ?>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">
              <i class="fas fa-user-friends fa-fw "></i>
              <!--Usuarios Registrados-->
              <?php
              echo $totalUsuarios;
              ?>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="<?php echo RUTA_LOGIN ?>"><span><i class="fas fa-sign-in-alt"></i></span> Iniciar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo RUTA_REGISTRO ?>"><i class="fas fa-plus"></i>Registro</a>
          </li>
        <?php
        }
        ?>


      </ul>

    </div>
  </div>
</nav>