<?php
  include_once 'app/Conexion.inc.php';
  include_once 'app/CRepositorioUsuarios.inc.php';
  
  Conexion:: openConexion();

  //$usuarios = CRepositorioUsuarios :: getAllUsers(Conexion::getConexion());
  $totalUsuarios = CRepositorioUsuarios :: getNumUsers(Conexion::getConexion());
  echo $totalUsuarios;
  Conexion:: closeConexion();
?>
<!doctype html>
<html lang="es">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
  <title>Blog 3</title>
  <link rel="stylesheet" href="./styles/mainStyles.css">
  <style>

    body {
      padding-top: 3.5rem;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-md  fixed-top bg-secondary">
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
            <a class="nav-link" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" >Disabled</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto mb-2 mb-md-0 ">
          <li class="nav-item active">
            <a class="nav-link" aria-current="page" href="#">Iniciar Sesion</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Registro</a>
          </li>

        </ul>

      </div>
    </div>
  </nav>
  <!--JUMBOTRON-->
  <div class="container ">
    <div class="jumbotron rounded-bottom my-3 h-50 p-3">
      <h1>Blog tercer intento</h1>
      <p>Blog dedicado a la programacion y desarrollo</p>
    </div>

  </div>

  <div class="container">
    <div class="row">
      <!--COLUMNA PRINCIPAL IZQUIERDA-->
      <div class="col-lg-4">

        <div class="row">
          <div class="col md-12">
            <div class="card">
              <div class="card-header"><i class="fas fa-search"></i>
                busqueda
              </div>
              <div class="card-body">
                <div class="form-group mb-3">
                  <input type="search" class="form-control" placeholder="¿Qué buscas? ">
                </div>
                <button class="form-control">BUSCAR</button>
              </div>
            </div>

          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><i class="fas fa-filter"></i>
                Filtro
              </div>
              <div class="card-body">
                <div class="form-group mb-3">

                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header"><i class="fas fa-calendar"></i>
                Calendario
              </div>
              <div class="card-body">
                <div class="form-group mb-3">

                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <!--COLUMNA PRINCIPAL DERECHA-->

      <div class="col-lg-8">
        <div class="card">
          <div class="card-header"><i class="far fa-sticky-note"></i>
            Ultimas entradas
          </div>
          <div class="card-body">
            
            <p>Todavia no hay entradas</p>
          </div>
        </div>
      </div>
    </div>
  </div>





  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
    crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
</body>

</html>