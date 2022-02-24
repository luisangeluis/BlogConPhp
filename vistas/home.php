<?php
include_once 'app/Conexion.inc.php';
include_once 'app/CRepositorioUsuarios.inc.php';
include_once 'app/EscritorDeEntradas.inc.php';

$titulo = 'Blog de JavaDevOne';

include_once './plantillas/documento-declaracion.inc.php';
include_once './plantillas/navbar.inc.php';

?>


<!--JUMBOTRON-->
<div class="container">
  <div class="jumbotron rounded my-3 px-5 ">
    <h1 class="">Blog Luis</h1>
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
              <form role="form" method="POST" action="<?php echo RUTA_BUSCADOR?>">
                <div class="form-group mb-3">
                  <input type="search" class="form-control" placeholder="¿Qué buscas?" name="termino-a-buscar" required>
                </div>
                <button class="form-control btn btn-primary" type="submit" name="buscar">BUSCAR</button>
              </form>
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
      <?php
      EscritorioDeEntradas::GetAllEntradas();
      ?>
    </div>
  </div>
</div>


<?php
include_once './plantillas/documento-cierre.inc.php';
?>