<?php
  include("datos/conex.inc");
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="./">Ayudantia</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSeccion1" aria-controls="navbarSeccion1" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSeccion1">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0" id="ul_barraSeccion1">
      <li class="nav-item">
        <a class="nav-link" href="./">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" onclick="ObtenerModalSeccion1(3)" data-toggle="modal" data-target="#ModalSeccion1">Descargas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" onclick="ObtenerModalSeccion1(4)" data-toggle="modal" data-target="#ModalSeccion1">Contacto</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          if(isset($_SESSION['correo']))
          {
            echo 'Activo ['.$_SESSION["correo"].']';
          }
          else
          {
            echo 'Login';
          }
          ?>
        </a>
        <?php
          echo '<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">';
          if(isset($_SESSION['correo']))
          {
            echo '
            <a class="dropdown-item" onclick="ObtenerModalSeccion1(5)" data-toggle="modal" data-target="#ModalSeccion1">Configurar Perfil</a>
            <a class="dropdown-item" onclick="ObtenerModalSeccion1(6)" data-toggle="modal" data-target="#ModalSeccion1">Cerrar Sesión</a>';
          }
          else
          {
            echo '
              <a class="dropdown-item" onclick="ObtenerModalSeccion1(1)" data-toggle="modal" data-target="#ModalSeccion1">Iniciar Sesión</a>
              <a class="dropdown-item" onclick="ObtenerModalSeccion1(2)" data-toggle="modal" data-target="#ModalSeccion1">Registrarme</a>';
          }
          echo '</div>';
        ?>
      </li>
    </ul>
  </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="ModalSeccion1" tabindex="-1" role="dialog" aria-labelledby="ModalPrincipio" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalPrincipio">Titulo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="contenidoModal">
          
        </div>
      </div>
    </div>
  </div>