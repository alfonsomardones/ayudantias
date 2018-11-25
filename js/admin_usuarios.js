$(document).ready(function() {
	mostrarUsuarios();
});

function modalUsuario(tipo,dato){
	if(!dato)
	{dato = '';}
	$('#contenidoModalUsuario').html('<div class="container-fluid text-center d-flex align-items-center" style="height:300px;"><img src="../img/iconos/loading.gif" title="CARGANDO" width="100px" style="margin:auto"></div>');
	titulo = ''; url = '';
	if(tipo==1)
	{
		if($('.modal-dialog').hasClass('modal-sm'))
			{$('.modal-dialog').removeClass('modal-sm')}
		$('.modal-dialog').addClass('modal-lg');
		titulo = 'REGISTRAR USUARIO'; url = 'registrar.php';
		$.ajax({
			type:"POST",
			url:url,
			success: function(data)
			{$('#contenidoModalUsuario').html(data);}
		});
	}
	else if(tipo==2)
	{
		if($('.modal-dialog').hasClass('modal-sm'))
			{$('.modal-dialog').removeClass('modal-sm')}
		$('.modal-dialog').addClass('modal-lg');
		titulo = 'EDITAR USUARIO'; url = 'editar.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{id:dato},
			success: function(data)
			{$('#contenidoModalUsuario').html(data);}
		});
	}
	else if(tipo==3)
	{
		titulo = 'BORRAR USUARIO'; url = 'borrar.php';
		if($('.modal-dialog').hasClass('modal-lg'))
		{$('.modal-dialog').removeClass('modal-lg');}
		$.ajax({
			type:"POST",
			url:url,
			data:{id:dato},
			success: function(data)
			{$('#contenidoModalUsuario').html(data);}
		});
	}
}

function registrarUsuario(){
	nombres = ''; apellidos = ''; rut = ''; correo = ''; telefono = ''; fecha_nac = ''; sexo = '';
	estado = ''; tipo = ''; direccion = ''; region = ''; comuna = ''; institucion = ''; unidad = '';

	if(formRegistroUsuario() && formAdminInstitucion())
	{
		if($('#nombres').length)		{	nombres 	= $('#nombres').val();}
		if($('#apellidos').length)		{	apellidos 	= $('#apellidos').val();}
		if($('#rut').length)			{	rut 		= $('#rut').val();}
		if($('#correo').length)			{	correo 		= $('#correo').val();}
		if($('#telefono').length)		{	telefono 	= $('#telefono').val();}
		if($('#fecha_nacimiento').length){	fecha_nac 	= $('#fecha_nacimiento').val();}
		if($('#sexo').length)			{	sexo 		= $('#sexo').val();}
		if($('#estado').length)			{	estado 		= $('#estado').val();}
		if($('#tipo').length)			{	tipo 		= $('#tipo').val();}
		if($('#direccion').length)		{	direccion 	= $('#direccion').val();}
		if($('#region').length)			{	region 		= $('#region').val();}
		if($('#comuna').length)			{	comuna 		= $('#comuna').val();}
		if($('#instituciones').length)	{	institucion = $('#instituciones').val();}
		if($('#unidades').length)		{	unidad 		= $('#unidades').val();}

		url = '../datos/registrar_usuario.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{
				nombres:nombres, apellidos:apellidos,
				rut:rut, correo:correo, telefono:telefono, fecha_nac:fecha_nac,
				sexo:sexo, estado:estado, tipo:tipo,
				direccion:direccion, region:region, comuna:comuna,
				institucion:institucion, unidad:unidad
			},
			success: function(data)
			{
				$('#infoRegistroUsuario').html(mostrarMensaje(listadoMensajes(data)));
				if(data == 2){
            		mostrarUsuarios();
            		setTimeout(ocultarModal1,100);
            	}
			}
		});
	}
}

function actualizarUsuario(x){
	nombres = ''; apellidos = ''; rut = ''; correo = ''; telefono = ''; fecha_nac = ''; sexo = '';
	estado = ''; tipo = ''; direccion = ''; region = ''; comuna = '';

	if(formRegistroUsuario())
	{
		id = x;
		if($('#nombres').length)		{	nombres 	= $('#nombres').val();}
		if($('#apellidos').length)		{	apellidos 	= $('#apellidos').val();}
		if($('#rut').length)			{	rut 		= $('#rut').val();}
		if($('#correo').length)			{	correo 		= $('#correo').val();}
		if($('#telefono').length)		{	telefono 	= $('#telefono').val();}
		if($('#fecha_nacimiento').length){	fecha_nac 	= $('#fecha_nacimiento').val();}
		if($('#sexo').length)			{	sexo 		= $('#sexo').val();}
		if($('#estado').length)			{	estado 		= $('#estado').val();}
		if($('#tipo').length)			{	tipo 		= $('#tipo').val();}
		if($('#direccion').length)		{	direccion 	= $('#direccion').val();}
		if($('#region').length)			{	region 		= $('#region').val();}
		if($('#comuna').length)			{	comuna 		= $('#comuna').val();}

		url = '../datos/actualizar_usuario.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{
				id:id, nombres:nombres, apellidos:apellidos,
				rut:rut, correo:correo, telefono:telefono, fecha_nac:fecha_nac,
				sexo:sexo, estado:estado, tipo:tipo,
				direccion:direccion, region:region, comuna:comuna},
			success: function(data)
			{
				$('#infoEditarUsuario').html(mostrarMensaje(listadoMensajes(data)));
				if(data == 3){
            		mostrarUsuarios();
            		setTimeout(ocultarModal1,500);
            	}
			}
		});
	}
}

function mostrarUsuarios(){
	id = ''; nombres = ''; apellidos = ''; rut = ''; correo = ''; sexo = '';
	estado = ''; tipo = ''; region = ''; comuna = '';
	$('#controlUsuarios').html('<div class="container-fluid text-center d-flex align-items-center" style="height:150px;"><img src="../img/iconos/loading.gif" title="CARGANDO" width="100px" style="margin:auto"></div>');
	if($('#b_id').length)				{	id 			= $('#b_id').val();}
	if($('#b_nombres').length)			{	nombres 	= $('#b_nombres').val();}
	if($('#b_apellidos').length)		{	apellidos 	= $('#b_apellidos').val();}
	if($('#b_rut').length)				{	rut 		= $('#b_rut').val();}
	if($('#b_correo').length)			{	correo 		= $('#b_correo').val();}
	if($('#b_sexo').length)				{	sexo 		= $('#b_sexo').val();}
	if($('#b_estado').length)			{	estado 		= $('#b_estado').val();}
	if($('#b_tipo').length)				{	tipo 		= $('#b_tipo').val();}
	if($('#b_region').length)			{	region 		= $('#b_region').val();}
	if($('#b_comuna').length)			{	comuna 		= $('#b_comuna').val();}
	url = 'control.php';
	$.ajax({
		type:"POST",
		url:url,
		data:{
			id:id, nombres:nombres, apellidos:apellidos,
			rut:rut, correo:correo, sexo:sexo, estado:estado, tipo:tipo,
		 	region:region, comuna:comuna},
		success: function(data)
		{$('#controlUsuarios').html(data);}
	});
}

function borrarUsuario(x){
	url = '../datos/borrar_usuario.php';
	$.ajax({
		type:"POST",
		url:url,
		data:{id:x},
		success: function(data)
		{
			$('.modal-body').html(mostrarMensaje(listadoMensajes(data)));
            if(data == 4){
            	mostrarUsuarios()
            	setTimeout(ocultarModal1,500);}
            else{$('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>')}
		}
	});
}

function ocultarModal1(){$('#modalUsuario').modal('toggle');}


/*
function subirOrden(x){
	var inputFileImage = document.getElementById("imagen");
	var file = inputFileImage.files[0];
	var datos = new FormData();
	datos.append("archivo",file);
	var url = "datos/subir_orden.php";
	$.ajax({
		url:url,
		type:"POST",
		contentType:false,
		data:datos,
		processData:false,
		cache:false,
		success: function(data)
		{
			
		}
	});
}
*/

