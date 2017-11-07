<?php
session_start();
//consultar a la BD
if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['nombre_tipo_usuario']=="Administrador Máster")
	{
		include("../datos/conex.php");
		echo "<div class='container-fluid'>
			<div class='row'>
				<div class='col-md-6'>
					<h4>Registro de Usuarios</h4>";
			$sql      = "SELECT DISTINCT año_registro FROM usuarios ORDER BY año_registro DESC";
			$resultado    = mysqli_query($db,$sql);
			$contador     = mysqli_num_rows($resultado);
			if($contador>0)
			{
				echo "<div class='form-inline'>";
				echo "<select id='input_año' class='form-control'>";
				while ($lista = mysqli_fetch_array($resultado))
				{
					$año_registro   = $lista['año_registro'];
					echo "<option value='".$año_registro."'>$año_registro</option>";
				}
				echo "</select>";

				echo "<select id='input_mes' class='form-control' onchange='actualizarSelectDia()'>";
				$meses = ["Todos los Meses","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

				for($i = 0;$i<13;$i++)
				{
					echo "<option value='".$i."'>".$meses[$i]."</option>";
				}
				echo "</select>";

				echo "<select id='input_dia' class='form-control'>";
				echo "<option ='0'>Todos los días</option>";
				echo "</select>";
				echo "<input type='button' value='Buscar' onclick='obtenerGraficoRegistroUsuarios()' class='btn btn-warning'>";
				echo "</div>";
			}
			else
			{
				echo "No hay usuarios registrados";
			}
			echo "<div id='graficoRegistros'>Aquí va gráfico</div>
				</div>";
		echo "<div class='col-md-3'>
				<h4>Tipos de usuario</h4><input type='button' value='Buscar' onclick='obtenerGraficoTipodeUsuarios()' class='btn btn-warning'>
			<div id='graficoTiposUsuarios'>Aquí va gráfico</div>
				</div>";
		echo "<div class='col-md-3'><h4>Gráfico</h4></div>";

		echo "<div class='col-md-4'>Seleccionar institucion</div>";
		echo "<div class='col-md-4'>Seleccionar institucion</div>";
		echo "<div class='col-md-4'>Seleccionar institucion</div>";
		echo "</div></div>";
	}
	else
	{
		echo '<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No tienes permisos para esto.</strong></div>';
	}
}
else
{
  echo '<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>No has iniciado sesión.</strong></div>';
}