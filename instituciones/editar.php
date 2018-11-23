<?php
if(!isset($_SESSION))
{session_start();}
include('../datos/mensajes.php');
echo '
<div class="modal-header">
	<h5 class="modal-title">EDITAR INSTITUCIÓN</h5>
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
			$sql = 'SELECT * FROM instituciones WHERE id_institucion='.$_POST['id'];
			$resultados = mysqli_query($db, $sql);
			$contador = mysqli_num_rows($resultados);
			if($contador==1)
			{
				$lista = mysqli_fetch_assoc($resultados);
				$id 	= $lista['id_institucion'];
				$nombre 	= $lista['nombre'];
				$fecha_registro = $lista['fecha_registro'];
				
				echo '
				<div class="modal-body">
					<div class="container-fluid">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" id="nombre" placeholder="NOMBRE" title="NOMBRE" value="'.$nombre.'" onkeypress="return soloLetras(event)">
								</div>
							</div>
							<div class="col-12 col-md-6">
								<div class="form-group">
									<input type="text" class="form-control" id="fecha_registro" placeholder="FECHA DE REGISTRO" title="FECHA DE REGISTRO" value="'.$fecha_registro.'" readonly>
								</div>
							</div>
							<div class="col-12" id="infoEditarInstitucion"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-danger" title="BORRAR INSTITUCIÓN" onclick="modalInstitucion(3,'.$id.')">BORRAR</button>
					<button type="button" class="btn btn-info" onclick="actualizarInstitucion('.$id.')" title="ACTUALIZAR">ACTUALIZAR</button>
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