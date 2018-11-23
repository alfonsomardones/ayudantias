<?php
if(!isset($_SESSION))
{session_start();}
echo '
<nav class="navbar navbar-expand-md navbar-dark';
  if($_SERVER['PHP_SELF']=='/hmapp/login/index.php')
    echo ' fixed-top transparente';
  else
    {echo' bg-dark';}
  echo '">

  <a class="navbar-brand" href="';
  if($_SERVER['PHP_SELF']=='/hmapp/index.php')
  {echo './';}
  else
  {echo '../';}
  echo '"><span>Help Me App</span></a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#barra_nav" aria-controls="barra_nav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="barra_nav">
    <ul class="navbar-nav">';
      if(isset($_SESSION['id_usuario']))
      {
        echo '
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mis opciones</a>
          <div class="dropdown-menu dropdown-menu-right scrollable-menu">';
            $dir = '';
            if($_SERVER['PHP_SELF']=='/hmapp/index.php')
            {$dir = './';}
            else
            {$dir = '../';}
            echo '<a class="dropdown-item" href="'.$dir.'home/">Dashboard</a>';
            if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
            {
              echo '
              <a class="dropdown-item" href="'.$dir.'usuarios/">Usuarios</a>
              <a class="dropdown-item" href="'.$dir.'instituciones/">Instituciones</a>
              <a class="dropdown-item" href="'.$dir.'facultades/">Facultades</a>
              <a class="dropdown-item" href="'.$dir.'carreras/">Carreras</a>
              <a class="dropdown-item" href="'.$dir.'ayudantes/">Ayudantes</a>
              <a class="dropdown-item" href="'.$dir.'reportes/">Reportes</a>';
            }
            elseif ($_SESSION['tipo_usuario']=='ADMINISTRADOR DE INSTITUCIÓN') {
              echo '
              <a class="dropdown-item" href="'.$dir.'ayudantes/">Ayudantes</a>
              <a class="dropdown-item" href="'.$dir.'reportes/">Reportes</a>';
            }
            elseif ($_SESSION['tipo_usuario']=='SUB-ADMINISTRADOR DE INSTITUCIÓN') {
              echo '
              <a class="dropdown-item" href="'.$dir.'ayudantes/">Ayudantes</a>
              <a class="dropdown-item" href="'.$dir.'reportes/">Reportes</a>';
            }
            echo '
          </div>
        </li>';

        echo '
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
          if(isset($_SESSION['img']))
          {
            if($_SERVER['PHP_SELF']=='/hmapp/index.php')
            {$img = 'img/perfil_usuarios/'.$_SESSION['img'];}
            else
            {$img = '/hmapp/img/perfil_usuarios/'.$_SESSION['img'];}
            echo '<img class="avatar_img" src="'.$img.'"> ';
          }
          echo $_SESSION['nombre'].'</a>
          <div class="dropdown-menu dropdown-menu-right scrollable-menu">
            <a class="dropdown-item" href="#">Mis datos</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal_cerrar_sesion">Cerrar sesión</a>
          </div>
        </li>';
      }
      else
      {
        echo '
        <li class="nav-item';
        if($_SERVER['PHP_SELF']=='/hmapp/index.php')
        {echo ' active';}
        echo '">
          <a class="nav-link" href="/hmapp/">Inicio</a>
        </li>
        <li class="nav-item';
        if($_SERVER['PHP_SELF']=='/hmapp/nosotros/index.php')
        {echo ' active';}
        echo '">
          <a class="nav-link" href="/hmapp/nosotros/">Nosotros</a>
        </li>
        <li class="nav-item';
        if($_SERVER['PHP_SELF']=='/hmapp/contacto/index.php')
        {echo ' active';}
        echo '">
          <a class="nav-link" href="/hmapp/contacto/">Contacto</a>
        </li>
        <li class="nav-item';
        if($_SERVER['PHP_SELF']=='/hmapp/login/index.php')
        {echo ' active';}
        echo '">
          <a class="nav-link" href="/hmapp/login/">Login</a>
        </li>
        ';
      }
      echo '
    </ul>
  </div>
</nav>';
?>