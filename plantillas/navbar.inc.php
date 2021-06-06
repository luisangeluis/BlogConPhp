<?php
    Conexion:: openConexion();

    //$usuarios = CRepositorioUsuarios :: getAllUsers(Conexion::getConexion());
    $totalUsuarios = CRepositorioUsuarios :: getNumUsers(Conexion::getConexion());
    // echo $totalUsuarios;
    Conexion:: closeConexion();
?>
<nav class="navbar navbar-expand-md bg-secondary ">
    <div class="container">
      <a class="navbar-brand" href="#">BLOG LUIS-3</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="visually-hidden">Boton para barra de navegacion</span>
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarCollapse">

        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">Entradas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Favoritos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" >Autores</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto mb-2 mb-md-0 ">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">
            <i class="fas fa-user-friends"></i> <!--Usuarios Registrados-->
            <?php
              echo $totalUsuarios;
            ?>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#"><span><i class="fas fa-sign-in-alt"></i></span>Iniciar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registro.php"><i class="fas fa-plus"></i>Registro</a>
          </li>

        </ul>

      </div>
    </div>
  </nav>