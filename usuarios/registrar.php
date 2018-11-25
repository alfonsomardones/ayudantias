<?php
if(!isset($_SESSION['id_usuario']))
{session_start();}

include('../datos/mensajes.php');
echo '
<div class="modal-header">
	<h5 class="modal-title">REGISTRAR USUARIO</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>';
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<div class="modal-body">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 my-2">
						<h5>DATOS PERSONALES</h5>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" id="nombres" placeholder="NOMBRES" title="NOMBRES" onkeypress="return soloLetras(event)">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" id="apellidos" placeholder="APELLIDOS" title="APELLIDOS" onkeypress="return soloLetras(event)">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" id="rut" placeholder="RUT" title="RUT" onkeypress="return limpiarRut(event)" onkeyup="formateaRut(this)">
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" id="correo" placeholder="CORREO" title="CORREO" onkeypress="return soloCorreoClave(event)" >
						</div>
					</div>
					<div class="col-6 col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" id="telefono" placeholder="TELÉFONO" title="TELÉFONO" onkeypress="return soloTelefono(event)" >
						</div>
					</div>
					<div class="col-6 col-md-4">
						<div class="form-group">
							<input type="date" class="form-control" id="fecha_nacimiento" placeholder="FECHA DE NACIMIENTO" title="FECHA DE NACIMIENTO">
						</div>
					</div>

					<div class="col-6 col-md-4">
						<div class="form-group">
							<select class="form-control" id="sexo" title="SEXO">
								<option value="">SEXO</option>
								<option value="MASCULINO">MASCULINO</option>
								<option value="FEMENINO">FEMENINO</option>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-4">
						<div class="form-group">
							<select class="form-control" id="tipo" title="TIPO DE USUARIO" onchange="opcionesTipoUsuario(this)">
								<option value="">TIPO USUARIO</option>
								<option value="1">ADMINISTRADOR SUPERIOR</option>
								<option value="2">ADMINISTRADOR DE INSTITUCIÓN</option>
								<option value="3">SUB-ADMINISTRADOR DE INSTITUCIÓN</option>
								<option value="4">ESTUDIANTE</option>
								<option value="5">AYUDANTE</option>

							</select>
						</div>
					</div>
					<div class="col-6 col-md-4">
						<div class="form-group">
							<select class="form-control" id="estado" title="ESTADO PENDIENTE POR DEFECTO">
								<option value="PENDIENTE">ESTADO</option>
								<option value="PENDIENTE">PENDIENTE</option>
								<option value="HABILITADO">HABILITADO</option>
								<option value="DESHABILITADO">DESHABILITADO</option>
							</select>
						</div>
					</div>
					

					<div class="col-12 col-md-4">
						<div class="form-group">
							<input type="text" class="form-control" id="direccion" placeholder="DIRECCIÓN" title="DIRECCIÓN">
						</div>
					</div>
					<div class="col-6 col-md-4">
						<div class="form-group">
							<select class="form-control" id="region" title="REGIÓN" onchange="listCom()">
								<option value="">SELECCIONE REGIÓN</option>
								<option value="ARICA Y PARINACOTA">ARICA Y PARINACOTA</option>
								<option value="TARAPACÁ">TARAPACÁ</option>
								<option value="ANTOFAGASTA">ANTOFAGASTA</option>
								<option value="ATACAMA">ATACAMA</option>
								<option value="COQUIMBO">COQUIMBO</option>
								<option value="VALPARAÍSO">VALPARAÍSO</option>
								<option value="REGIÓN DEL LIBERTADOR GRAL. BERNARDO O’HIGGINS">REGIÓN DEL LIBERTADOR GRAL. BERNARDO O’HIGGINS</option>
								<option value="REGIÓN DEL MAULE">REGIÓN DEL MAULE</option>
								<option value="REGIÓN DEL BIOBÍO">REGIÓN DEL BIOBÍO</option>
								<option value="REGIÓN DE LA ARAUCANÍA">REGIÓN DE LA ARAUCANÍA</option>
								<option value="REGIÓN DE LOS RÍOS">REGIÓN DE LOS RÍOS</option>
								<option value="REGIÓN DE LOS LAGOS">REGIÓN DE LOS LAGOS</option>
								<option value="REGIÓN AISÉN DEL GRAL. CARLOS IBÁÑEZ DEL CAMPO">REGIÓN AISÉN DEL GRAL. CARLOS IBÁÑEZ DEL CAMPO</option>
								<option value="REGIÓN DE MAGALLANES Y DE LA ANTÁRVCA CHILENA">REGIÓN DE MAGALLANES Y DE LA ANTÁRVCA CHILENA</option>
								<option value="REGIÓN METROPOLITANA DE SANTIAGO">REGIÓN METROPOLITANA DE SANTIAGO</option>
							</select>
						</div>
					</div>
					<div class="col-6 col-md-4">
						<div class="form-group"><select class="form-control" id="comuna"><option value="">SELECCIONE COMUNA</option></select></div>
						<script>listCom()</script>
					</div>
					<div class="col-12">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="imagen" required  accept="image/*">
							<label class="custom-file-label" for="imagen">IMAGEN DE PERFIL</label>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 my-2">
						<h5>OTROS DATOS</h5>
					</div>
				</div>
				<div class="row py-2" id="infoOtrosDatos">
					<div class="col-12">
						<div class="alert alert-warning alert-dismissible fade show" role="alert">
							DEBE SELECCIONAR EL TIPO DE USUARIO
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
    						</button>
  						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12" id="infoRegistroUsuario"></div>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-info" onclick="registrarUsuario()" title="REGISTRAR USUARIO">REGISTRAR</button>
			<button type="button" class="btn btn-secondary" data-dismiss="modal" title="CANCELAR">CANCELAR</button>
			
		</div>';
	}
	else
	{
		echo '
	<div class="modal-body">
		<p class="lead">'.mensajes(-52).'</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>
	</div>';
	}
}
else
{
	echo '
	<div class="modal-body">
		<p class="lead">'.mensajes(-51).'</p>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>
	</div>';
}
echo '</div></div></div>';