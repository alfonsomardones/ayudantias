<?php
if(!isset($_SESSION))
{session_start();}

if(isset($_SESSION['id_usuario']))
{
	if($_SESSION['tipo_usuario']=='ADMINISTRADOR SUPERIOR')
	{
		echo '
		<div class="col-6 col-md-1">
			<div class="form-group">
				<input type="text" class="form-control form-control-sm" id="b_id" placeholder="ID" title="BUSCAR POR ID"';
				if(isset($_GET['id']))
				{echo ' value="'.$_GET['id'].'"';}
				echo '>
			</div>
		</div>
		<div class="col-6 col-md-2">
			<div class="form-group">
				<input type="text" class="form-control form-control-sm" id="b_rut" placeholder="RUT" title="BUSCAR POR RUT"  onkeypress="return limpiarRut(event)" onkeyup="formateaRut(this)"';
				if(isset($_GET['rut']))
				{echo ' value="'.$_GET['rut'].'"';}
				echo '>
			</div>
		</div>
		<div class="col-6 col-md-3">
			<div class="form-group">
				<input type="text" class="form-control form-control-sm" id="b_nombres" placeholder="NOMBRES" title="BUSCAR POR NOMBRES"';
				if(isset($_GET['nombres']))
				{echo ' value="'.$_GET['nombres'].'"';}
				echo '>
			</div>
		</div>
		<div class="col-6 col-md-3">
			<div class="form-group">
				<input type="text" class="form-control form-control-sm" id="b_apellidos" placeholder="APELLIDOS" title="BUSCAR POR APELLIDOS"';
				if(isset($_GET['apellidos']))
				{echo ' value="'.$_GET['apellidos'].'"';}
				echo '>
			</div>
		</div>
		<div class="col-6 col-md-3">
			<div class="form-group">
				<input type="text" class="form-control form-control-sm" id="b_correo" placeholder="CORREO" title="BUSCAR POR CORREO"';
				if(isset($_GET['correo']))
				{echo ' value="'.$_GET['correo'].'"';}
				echo '>
			</div>
		</div>
		<div class="col-6 col-md-2">
			<div class="form-group">
				<select id="b_tipo" class="form-control form-control-sm" title="BUSCAR POR TIPO DE USUARIO">
					<option value="" selected>TIPO USUARIO</option>
					<option value="1"';
					if(isset($_GET['tipo']))
					{
						if($_GET['tipo']==1)
						{echo ' selected';}
					}
					echo '>ADMINISTRADOR SUPERIOR</option>
					<option value="2"';
					if(isset($_GET['tipo']))
					{
						if($_GET['tipo']==2)
						{echo ' selected';}
					}
					echo '>ADMINISTRADOR DE INSTITUCIÓN</option>
					<option value="3"';
					if(isset($_GET['tipo']))
					{
						if($_GET['tipo']==3)
						{echo ' selected';}
					}
					echo '>SUB-ADMINISTRADOR DE INSTITUCIÓN</option>
					<option value="4"';
					if(isset($_GET['tipo']))
					{
						if($_GET['tipo']==4)
						{echo ' selected';}
					}
					echo '>USUARIO</option>
					<option value="5"';
					if(isset($_GET['tipo']))
					{
						if($_GET['tipo']==5)
						{echo ' selected';}
					}
					echo '>AYUDANTE</option>
				</select>
			</div>
		</div>
		<div class="col-6 col-md-2">
			<div class="form-group">
				<select id="b_sexo" class="form-control form-control-sm" title="BUSCAR POR SEXO">
					<option value="" selected>SEXO</option>
					<option value="MASCULINO"';
					if(isset($_GET['sexo']))
					{
						if($_GET['sexo']=='MASCULINO')
						{echo ' selected';}
					}
					echo '>MASCULINO</option>
					<option value="FEMENINO"';
					if(isset($_GET['sexo']))
					{
						if($_GET['sexo']=='FEMENINO')
						{echo ' selected';}
					}
					echo '>FEMENINO</option>
				</select>
			</div>
		</div>
		<div class="col-6 col-md-2">
			<div class="form-group">
				<select id="b_estado" class="form-control form-control-sm" title="BUSCAR POR ESTADO">
					<option value="" selected>ESTADO</option>
					<option value="PENDIENTE"';
					if(isset($_GET['estado']))
					{
						if($_GET['estado']=='PENDIENTE')
						{echo ' selected';}
					}
					echo '>PENDIENTE</option>
					<option value="HABILITADO"';
					if(isset($_GET['estado']))
					{
						if($_GET['estado']=='HABILITADO')
						{echo ' selected';}
					}
					echo '>HABILITADO</option>
					<option value="DESHABILITADO"';
					if(isset($_GET['estado']))
					{
						if($_GET['estado']=='DESHABILITADO')
						{echo ' selected';}
					}
					echo '>DESHABILITADO</option>
				</select>
			</div>
		</div>
		
		<div class="col-6 col-md-2">
			<div class="form-group">
				<select class="form-control form-control-sm" id="b_region" title="SELECCIONE REGIÓN" onchange="listCom2()">
					<option value="" selected="">SELECCIONE REGIÓN</option>
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

		<div class="col-6 col-md-2">
			<div class="form-group">
				<select class="form-control form-control-sm" id="b_comuna" title="SELECCIONE COMUNA">
					<option value="">SELECCIONE COMUNA</option>
				</select>
			</div>
		</div>
		<div class="col-12 col-md-2">
			<div class="form-group">
				<button class="btn btn-info btn-block btn-sm" title="REALIZAR BÚSQUEDA BUSCAR" onclick="mostrarUsuarios()"><span class="glyphicon glyphicon-search d-block d-md-none"></span><span class="d-none d-md-block"> BUSCAR</span></button>
			</div>
		</div>
		';
	}
}
?>