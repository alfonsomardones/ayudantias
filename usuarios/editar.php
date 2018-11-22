<?php
if(!isset($_SESSION))
{session_start();}
include('../datos/mensajes.php');
echo '
<div class="modal-header">
	<h5 class="modal-title">EDITAR USUARIO</h5>
	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>';
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		if(isset($_POST['id']))
		{
			include('../datos/conexion.php');
			$sql = 'SELECT * FROM usuarios WHERE id_usuario='.$_POST['id'];
			$resultados = mysqli_query($db, $sql);
			$contador = mysqli_num_rows($resultados);
			if($contador==1)
			{
				$lista = mysqli_fetch_assoc($resultados);
				$id 	= $lista['id_usuario'];
				$nombres 	= $lista['nombres'];
				$apellidos 	= $lista['apellidos'];
				$rut 		= $lista['rut'];
				$correo 	= $lista['correo'];
				$telefono 	= $lista['telefono'];
				$fecha_nacimiento 	= $lista['fecha_nacimiento'];
				$sexo 				= $lista['sexo'];
				$estado 			= $lista['estado'];
				$tipo 				= $lista['id_tipo_usuario'];
				$direccion = $lista['direccion'];
				$region = $lista['region'];
				$comuna = $lista['comuna'];
				
				echo '
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" id="nombres" placeholder="NOMBRES" title="NOMBRES" value="'.$nombres.'">
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" id="apellidos" placeholder="APELLIDOS" title="APELLIDOS" value="'.$apellidos.'">
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" id="rut" placeholder="RUT" title="RUT"  onkeypress="return limpiarRut(event)" onkeyup="formateaRut()" value="'.$rut.'">
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" id="correo" placeholder="CORREO" title="CORREO" value="'.$correo.'">
								</div>
							</div>
							<div class="col-6 col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" id="telefono" placeholder="TELÉFONO" title="TELÉFONO" value="'.$telefono.'">
								</div>
							</div>
							<div class="col-6 col-md-4">
								<div class="form-group">
									<input type="date" class="form-control" id="fecha_nacimiento" placeholder="FECHA DE NACIMIENTO" title="FECHA DE NACIMIENTO" value="'.$fecha_nacimiento.'">
								</div>
							</div>

							<div class="col-6 col-md-4">
								<div class="form-group">
									<select class="form-control" id="sexo" title="SEXO">
										<option value=""';
										if($sexo=='')
										{echo ' selected';}
										echo '
										>SEXO</option>
										<option value="MASCULINO"';
										if($sexo=='MASCULINO')
										{echo ' selected';}
										echo '>MASCULINO</option>
										<option value="FEMENINO"';
										if($sexo=='FEMENINO')
										{echo ' selected';}
										echo '>FEMENINO</option>
									</select>
								</div>
							</div>

							<div class="col-6 col-md-4">
								<div class="form-group">
									<select class="form-control" id="estado" title="ESTADO PENDIENTE POR DEFECTO">
										<option value="PENDIENTE">ESTADO (PENDIENTE POR DEFECTO)</option>
										<option value="PENDIENTE"';
										if($estado=='PENDIENTE')
										{echo ' selected';}
										echo '>PENDIENTE</option>
										<option value="HABILITADO"';
										if($estado=='HABILITADO')
										{echo ' selected';}
										echo '>HABILITADO</option>
										<option value="DESHABILITADO"';
										if($estado=='DESHABILITADO')
										{echo ' selected';}
										echo '>DESHABILITADO</option>
									</select>
								</div>
							</div>
							<div class="col-12 col-md-4">
								<div class="form-group">
									<select class="form-control" id="tipo_usuario" title="TIPO DE USUARIO">
										<option value=""';
										if($tipo=='')
										{echo ' selected';}
										echo '>TIPO USUARIO</option>
										<option value="1"';
										if($tipo==1)
										{echo ' selected';}
										echo '>ADMINISTRADOR SUPERIOR</option>
										<option value="2"';
										if($tipo==2)
										{echo ' selected';}
										echo '>ADMINISTRADOR DE INSTITUCIÓN</option>
										<option value="3"';
										if($tipo==3)
										{echo ' selected';}
										echo '>SUB-ADMINISTRADOR DE INSTITUCIÓN</option>
										<option value="4"';
										if($tipo==4)
										{echo ' selected';}
										echo '>ESTUDIANTE</option>
										<option value="5"';
										if($tipo==5)
										{echo ' selected';}
										echo '>AYUDANTE</option>
									</select>
								</div>
							</div>

							<div class="col-12 col-md-4">
								<div class="form-group">
									<input type="text" class="form-control" id="direccion" placeholder="DIRECCIÓN" title="DIRECCIÓN" value="'.$direccion.'">
								</div>
							</div>
							<div class="col-6 col-md-4">
								<div class="form-group">
									<select class="form-control" id="region" title="REGIÓN" onchange="listCom()">
										<option value=""';
										if($region=='')
										{echo ' selected';}
										echo '>REGIÓN</option>
										<option value="ARICA Y PARINACOTA"';
										if($region=='ARICA Y PARINACOTA')
										{echo ' selected';}
										echo '>ARICA Y PARINACOTA</option>
										<option value="TARAPACÁ"';
										if($region=='TARAPACÁ')
										{echo ' selected';}
										echo '>TARAPACÁ</option>
										<option value="ANTOFAGASTA"';
										if($region=='ANTOFAGASTA')
										{echo ' selected';}
										echo '>ANTOFAGASTA</option>
										<option value="ATACAMA"';
										if($region=='ATACAMA')
										{echo ' selected';}
										echo '>ATACAMA</option>
										<option value="COQUIMBO"';
										if($region=='COQUIMBO')
										{echo ' selected';}
										echo '>COQUIMBO</option>
										<option value="VALPARAÍSO"';
										if($region=='VALPARAÍSO')
										{echo ' selected';}
										echo '>VALPARAÍSO</option>
										<option value="REGIÓN DEL LIBERTADOR GRAL. BERNARDO O’HIGGINS"';
										if($region=='REGIÓN DEL LIBERTADOR GRAL. BERNARDO O’HIGGINS')
										{echo ' selected';}
										echo '>REGIÓN DEL LIBERTADOR GRAL. BERNARDO O’HIGGINS</option>
										<option value="REGIÓN DEL MAULE"';
										if($region=='REGIÓN DEL MAULE')
										{echo ' selected';}
										echo '>REGIÓN DEL MAULE</option>
										<option value="REGIÓN DEL BIOBÍO"';
										if($region=='REGIÓN DEL BIOBÍO')
										{echo ' selected';}
										echo '>REGIÓN DEL BIOBÍO</option>
										<option value="REGIÓN DE LA ARAUCANÍA"';
										if($region=='REGIÓN DE LA ARAUCANÍA')
										{echo ' selected';}
										echo '>REGIÓN DE LA ARAUCANÍA</option>
										<option value="REGIÓN DE LOS RÍOS"';
										if($region=='REGIÓN DE LOS RÍOS')
										{echo ' selected';}
										echo '>REGIÓN DE LOS RÍOS</option>
										<option value="REGIÓN DE LOS LAGOS"';
										if($region=='REGIÓN DE LOS LAGOS')
										{echo ' selected';}
										echo '>REGIÓN DE LOS LAGOS</option>
										<option value="REGIÓN AISÉN DEL GRAL. CARLOS IBÁÑEZ DEL CAMPO"';
										if($region=='REGIÓN AISÉN DEL GRAL. CARLOS IBÁÑEZ DEL CAMPO')
										{echo ' selected';}
										echo '>REGIÓN AISÉN DEL GRAL. CARLOS IBÁÑEZ DEL CAMPO</option>
										<option value="REGIÓN DE MAGALLANES Y DE LA ANTÁRVCA CHILENA"';
										if($region=='REGIÓN DE MAGALLANES Y DE LA ANTÁRVCA CHILENA')
										{echo ' selected';}
										echo '>REGIÓN DE MAGALLANES Y DE LA ANTÁRVCA CHILENA</option>
										<option value="REGIÓN METROPOLITANA DE SANTIAGO"';
										if($region=='REGIÓN METROPOLITANA DE SANTIAGO')
										{echo ' selected';}
										echo '>REGIÓN METROPOLITANA DE SANTIAGO</option>
									</select>
								</div>
							</div>
							<div class="col-6 col-md-4">
								<div class="form-group"><select class="form-control" id="comuna"><option value="">COMUNA</option></select></div>';
								$comuna = "'".$comuna."'";
								echo '
								<script>
								listCom('.$comuna.');
								</script>
							</div>
							<div class="col-6 col-md-4" id="infoEditarUsuario"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger float-left" title="BORRAR USUARIO" onclick="modalUsuario(3,'.$id.')">BORRAR</button>
					<button type="button" class="btn btn-info" onclick="actualizarUsuario('.$id.')" title="ACTUALIZAR">ACTUALIZAR</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal" title="CANCELAR">CANCELAR</button>
				</div>';
			}
			else
			{
				echo '
				<div class="modal-body">
					<p class="lead">'.mensajes(-105).'</p>
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
				<p class="lead">'.mensajes(-55).'</p>
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