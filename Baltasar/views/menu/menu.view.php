<nav class="navbar navbar-default navbar-static-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Baltasar</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <?php
      require_once("./../../application.php");

      echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Operaciones <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="'.APP_ROOT.'/operaciones/liquidarValores.php">Liquidar Valores</a></li>
                    <li><a href="./liquidarPreliquidaciones.php">Liquidar Pre-Liquidaciones</a></li>
                  </ul>
                </li>
              </ul>
            </div><!-- /.navbar-collapse -->';

      $formulario = 'LALALALALA';
    ?>
  </div><!-- /.container-fluid -->
</nav>

<?php
  //Navigation
  //echo "<H1>menu</H1>";
?>