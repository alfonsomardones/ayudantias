<?php
	include("datos/conex.php");
?>
<?php
if(isset($_SESSION['id_usuario']))
{
	echo '<div class="container-fluid">
			<div class="row">
				<div class="col-xs-12 col-md-2">
					<div class="panel-group" id="divBarraLateral">';
	if($_SESSION['nombre_tipo_usuario']=="Administrador Máster" AND $_SESSION['control_usuarios']=='si')
	{
		echo '<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-target="#opcionesUsuarios" data-parent="#divBarraLateral">
					<button type="button" class="btn btn-dark btn-block">Usuarios</button>
				</div>

				<div id="opcionesUsuarios" class="panel-collapse collapse">
					<li class="list-group-item"><a href="#" onclick="BarraControl(1,1)">Control de Usuarios</a></li>
			   		<li class="list-group-item"><a href="#" onclick="BarraControl(1,2)">Agregar Usuario</a></li>
				</div>
			</div>';
	}

	if(($_SESSION['nombre_tipo_usuario']=="Administrador Máster" OR $_SESSION['nombre_tipo_usuario']=="Administrador Institución") AND $_SESSION['control_ayudantes']=='si')
	{
		echo '<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-target="#opcionesAyudantes" data-parent="#divBarraLateral">
					<button type="button" class="btn btn-dark btn-block">Ayudantes</button>
				</div>
				<div id="opcionesAyudantes" class="panel-collapse collapse">
					<li class="list-group-item"><a href="#" onclick="BarraControl(2,1)">Control de Ayudantes</a></li>
					<li class="list-group-item"><a href="#" onclick="BarraControl(2,2)">Asociar a Carrera</a></li>
				</div>
			</div>';
	}

	if (($_SESSION['nombre_tipo_usuario']=="Administrador Máster") AND $_SESSION['control_instituciones']=='si')
	{
		echo '<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-target="#opcionesInstituciones" data-parent="#divBarraLateral">
					<button type="button" class="btn btn-dark btn-block">Instituciones</button>
				</div>
				<div id="opcionesInstituciones" class="panel-collapse collapse">
					<li class="list-group-item"><a href="#" onclick="BarraControl(3,1)">Control de Instituciones</a></li>
					<li class="list-group-item"><a href="#" onclick="BarraControl(3,2)">Agregar Institución</a></li>
					<li class="list-group-item"><a href="#" onclick="BarraControl(3,3)">Instituciones-Carreras</a></li>
					<li class="list-group-item"><a href="#" onclick="BarraControl(3,4)">Asociar Carreras</a></li>
					<li class="list-group-item"><a href="#" onclick="BarraControl(3,5)">Control Administradores</a></li>
				</div>
			</div>';
	}
	
	if (($_SESSION['nombre_tipo_usuario']=="Administrador Máster" OR $_SESSION['nombre_tipo_usuario']=="Administrador Institución") AND $_SESSION['control_carreras']=='si')
	{		
		echo '<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-target="#opcionesCarreras" data-parent="#divBarraLateral">
					<button type="button" class="btn btn-dark btn-block">Carreras</button>
				</div>
				<div id="opcionesCarreras" class="panel-collapse collapse">
					<li class="list-group-item"><a href="#" onclick="BarraControl(4,1)">Control de Carreras</a></li>
					<li class="list-group-item"><a href="#" onclick="BarraControl(4,2)">Agregar Carrera</a></li>
				</div>
			</div>';
	}


	if($_SESSION['nombre_tipo_usuario']=="Administrador Máster" OR $_SESSION['nombre_tipo_usuario']=="Administrador Institución")
	{
		echo '<div class="panel panel-default">
				<div class="panel-heading" data-toggle="collapse" data-target="#opcionesMensajes" data-parent="#divBarraLateral">
					<button type="button" class="btn btn-dark btn-block">Mensajes</button>
				</div>
				<div id="opcionesMensajes" class="panel-collapse collapse">
					<li class="list-group-item"><a href="#" onclick="BarraControl(5,1)">Ver mensajes</a></li>
					<li class="list-group-item"><a href="#" onclick="BarraControl(5,2)">Nuevo Mensaje</a></li>
				</div>
			</div>';
	}
		echo '	</div>
				</div>
			<div class="col-xs-12 col-md-10" id="divControl">
				<div id="tituloControl"><h2 id="tituloh2Control">Menú de Administración</h2></div>
				<div id="cuerpoControl"></div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="ModalSeccion2Cambios" tabindex="-1" role="dialog" aria-labelledby="modalCambios" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTituloCambios">Confirmar</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id="contenidoModalCambios">
	          
	        </div>
	      </div>
	    </div>
	  </div>
	 </div>
	';

}
else
{
	echo '<h1>Ayudantía</h1>';
}
?>