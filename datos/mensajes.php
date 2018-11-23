<?php
function mensajes($i){
	$descripcion = 'SIN ERROR ESTABLECIDO';
	// CORRECTO
	if($i==1)
	{$descripcion = 'INICIANDO SESIÓN';}
	if($i==2)
	{$descripcion = 'REGISTRADO CORRECTAMENTE';}
	if($i==3)
	{$descripcion = 'ACTUALIZADO CORRECTAMENTE';}
	if($i==4)
	{$descripcion = 'BORRADO CORRECTAMENTE';}
	if($i==5)
	{$descripcion = 'CUENTA ACTIVADA CORRECTAMENTE';}
	// ALERTA
	elseif($i==-1)
	{$descripcion = 'USUARIO O CONTRASEÑA INCORRECTOS';}
	elseif($i==-2)
	{$descripcion = 'COMPLETE TODOS LOS CAMPOS';}
	elseif($i==-3)
	{$descripcion = 'USUARIO NO REGISTRADO';}
	elseif($i==-4)
	{$descripcion = 'CONTRASEÑA INCORRECTA';}
	elseif($i==-5)
	{$descripcion = 'EL RUT YA SE ENCUENTRA REGISTRADO';}
	elseif($i==-6)
	{$descripcion = 'EL CORREO YA SE ENCUENTRA REGISTRADO';}

	// ERRORES
	elseif($i==-50)
	{$descripcion = 'USUARIO DESHABILITADO';}
	elseif($i==-51)
	{$descripcion = 'NO HAS INICIADO SESIÓN';}
	elseif($i==-52)
	{$descripcion = 'NO TIENES PERMISOS PARA REALIZAR ESTA ACCIÓN';}
	elseif($i==-53)
	{$descripcion = 'NO RECIBE TODOS LOS DATOS';}
	elseif($i==-54)
	{$descripcion = 'TU USUARIO NO ES ADMINISTRADOR, DEBES INICIAR SESIÓN DESDE LA APLICACIÓN';}
	elseif($i==-55)
	{$descripcion = 'SERVIDOR NO RECIBE ID';}
	elseif($i==-56)
    {$descripcion = 'HAY DATOS INGRESADOS QUE NO SON VÁLIDOS';}
	elseif($i==-57)
    {$descripcion = 'ESTE USUARIO YA ESTÁ REGISTRADO';}
	elseif($i==-58)
    {$descripcion = 'ESTA INSTITUCIÓN YA ESTÁ REGISTRADA';}
	elseif($i==-59)
    {$descripcion = 'ESTA FACULTAD YA ESTÁ REGISTRADA';}
	elseif($i==-60)
    {$descripcion = 'ESTA CARRERA YA ESTÁ REGISTRADA';}

	elseif($i==-100)
    {$descripcion = 'ERROR CONSULTA A BD';}
    elseif($i==-101)
    {$descripcion = 'NO SE HAN ENCONTRADO RESULTADOS DE BÚSQUEDA';}
	elseif($i==-102)
    {$descripcion = 'ERROR AL REGISTRAR EN BD';}
    elseif($i==-105)
    {$descripcion = 'USUARIO NO ENCONTRADO';}
    elseif($i==-106)
    {$descripcion = 'TIPO DE USUARIO NO ENCONTRADO';}
	elseif($i==-107)
    {$descripcion = 'ERROR AL ELIMINAR DE BD';}
	elseif($i==-108)
    {$descripcion = 'ERROR AL ACTUALIZAR EN BD';}
    
	$tip = 'danger';
	if($i>0)
    {$tip = 'success';}
    else
    {
        if($i>-50)
        {$tip = 'warning';}
        else
        {$tipo = 'danger';}
    }
	$descripcion = '
	<div class="alert alert-'.$tip.' alert-dismissible fade show" role="alert">
		'.$descripcion.'
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    		<span aria-hidden="true">&times;</span>
  		</button>
	</div>';
	return $descripcion;
}

function mostrar_mensaje($x){
	echo '<div class="col-0 col-md-3"></div><div class="col-12 col-md-6">'.$x.'</div>';
}
?>