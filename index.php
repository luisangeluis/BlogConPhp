<?php
  include_once 'app/Conexion.inc.php';
  include_once 'app/CRepositorioUsuarios.inc.php';
  
  
  include_once './plantillas/documento-declaracion.inc.php';
  include_once './plantillas/navbar.inc.php';
?>

  
  <!--JUMBOTRON-->
  <div class="container">
    <div class="jumbotron rounded my-3 px-5 ">
      
      <h1 class="">Blog tercer intento</h1>
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
          <div class="card-header"><i class="fas fa-list"></i>
            Ultimas entradas
          </div>
          <div class="card-body">
            
            <p>Todavia no hay entradas</p>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
include_once './plantillas/documento-cierre.inc.php';
?>


  