<nav class="navbar fixed-top navbar-expand-sm navbar-dark">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="./"><img src="img/logo_app.png" class="imagen-logo"></a>
	<div class="collapse navbar-collapse justify-content-end" id="nav-content">   
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="./">Inicio</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#ModalSeccion1" onclick="ObtenerModalSeccion1(3)">Descargas</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" data-toggle="modal" data-target="#ModalSeccion1" onclick="ObtenerModalSeccion1(4)">Contacto</a>
			<li class="nav-item">
				<div class="dropdown">
					<?php
						if(isset($_SESSION['id_usuario']))
						{
							/*'<div class="btn-group">*/
							echo '<button class="btn btn-dark dropdown-toggle" type="button" id="btn-InicioSesion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
							echo $_SESSION['nombre_apellido'];
							echo '</button>';
							echo '<button class="btn btn-dark" type="button" href="#" data-toggle="modal" data-target="#ModalSeccion1" onclick="ObtenerModalSeccion1(6)"><span class="glyphicon glyphicon-log-out"></span></button>';
							echo'
								<div class="dropdown-menu dropdown-menu-right scrollable-menu" aria-labelledby="btn-InicioSesion">
									<h6 class="dropdown-header">Personal</h6>
									<a class="dropdown-item" href="#" data-toggle="modal" data-target="#ModalSeccion1"  onclick="ObtenerModalSeccion1(5)">Editar perfil</a>
									<a class="dropdown-item" href="#" onclick="BarraControl(10,1)" id="seccion1-mensajes">Mensajes</a>';
							echo '<h6 class="dropdown-header">Mis opciones</h6>';
							if($_SESSION['nombre_tipo_usuario']=="Administrador Máster" AND $_SESSION['control_usuarios']=='si')
							{	
								echo '<h6 class="dropdown-header">Usuarios</h6>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(1,1)">Control Usuarios</a>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(1,2)">Agregar Usuario</a>';
							}
							if(($_SESSION['nombre_tipo_usuario']=="Administrador Máster" OR $_SESSION['nombre_tipo_usuario']=="Administrador Institución") AND $_SESSION['control_ayudantes']=='si')
							{
								echo '<h6 class="dropdown-header">Ayudantes</h6>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(2,1)">Control de Ayudantes</a>';
							}

							if (($_SESSION['nombre_tipo_usuario']=="Administrador Máster") AND $_SESSION['control_instituciones']=='si')
							{
								echo '<h6 class="dropdown-header">Instituciones</h6>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(3,1)">Control de Instituciones</a>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(3,2)">Agregar Institución</a>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(3,5)">Control de Administradores</a>';
							}

							if ($_SESSION['nombre_tipo_usuario']=="Administrador Institución" AND $_SESSION['control_carreras']=='si')
							{	
								echo '<h6 class="dropdown-header">Carreras</h6>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(4,1)">Control de Carreras</a>';
							}

							if ($_SESSION['nombre_tipo_usuario']=="Administrador Máster" AND $_SESSION['control_carreras']=='si')
							{	
								echo '<h6 class="dropdown-header">Carreras</h6>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(4,1)">Control de Carreras</a>';
								echo '<a class="dropdown-item" href="#" onclick="BarraControl(4,2)">Agregar Carrera</a>';
							}
							if ($_SESSION['nombre_tipo_usuario']=="Administrador Máster")
							{
								echo '<h6 class="dropdown-header">BASE DE DATOS</h6>';
								echo '<a class="dropdown-item" href="http://pillan.inf.uct.cl/~fvelasquez/bd/adminbd/?server=db.inf.uct.cl&username=fvelasquez&db=fvelasquez">BD pillan</a>';
							}
							echo '</div>';
						}
						else
						{
							echo '<button class="btn btn-dark" type="button" id="btn-InicioSesion" data-toggle="modal" data-target="#ModalSeccion1" onclick="ObtenerModalSeccion1(1)">Inicio sesión</button>';
						}
					?>
				</div>
			</li>
		</ul>
	</div>
</nav>

<!-- Modal -->
<div class="modal fade" id="ModalSeccion1" tabindex="-1" role="dialog" aria-labelledby="ModalPrincipio" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalPrincipio"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="color-blanco">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="contenidoModal">
          
        </div>
      </div>
    </div>
  </div>
 </div>