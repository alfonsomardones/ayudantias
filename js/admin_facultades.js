$(document).ready(function() {
	mostrarFacultades();
});

function modalFacultad(tipo,dato){
	if(!dato)
	{dato = '';}
	$('#contenidoModalFacultad').html('<div class="container-fluid text-center d-flex align-items-center" style="height:300px;"><img src="../img/iconos/loading.gif" title="CARGANDO" width="100px" style="margin:auto"></div>');
	titulo = ''; url = '';
	if(tipo==1)
	{
		if($('.modal-dialog').hasClass('modal-sm'))
			{$('.modal-dialog').removeClass('modal-sm')}
		$('.modal-dialog').addClass('modal-lg');
		titulo = 'REGISTRAR FACULTAD'; url = 'registrar.php';
		$.ajax({
			type:"POST",
			url:url,
			success: function(data)
			{$('#contenidoModalFacultad').html(data);}
		});
	}
	else if(tipo==2)
	{
		if($('.modal-dialog').hasClass('modal-sm'))
			{$('.modal-dialog').removeClass('modal-sm')}
		$('.modal-dialog').addClass('modal-lg');
		titulo = 'EDITAR FACULTAD'; url = 'editar.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{id:dato},
			success: function(data)
			{$('#contenidoModalFacultad').html(data);}
		});
	}
	else if(tipo==3)
	{
		titulo = 'BORRAR FACULTAD'; url = 'borrar.php';
		if($('.modal-dialog').hasClass('modal-lg'))
		{$('.modal-dialog').removeClass('modal-lg');}
		$.ajax({
			type:"POST",
			url:url,
			data:{id:dato},
			success: function(data)
			{$('#contenidoModalFacultad').html(data);}
		});
	}
}

function registrarFacultad(){
	nombre = ''; 
	if(formRegistroFacultad())
	{
		if($('#nombre').length)		{	nombre 	= $('#nombre').val();}

		url = '../datos/registrar_facultad.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{nombre:nombre},
			success: function(data)
			{
				$('#infoRegistroFacultad').html(mostrarMensaje(listadoMensajes(data)));
				if(data == 2){
            		mostrarFacultades();
            		setTimeout(ocultarModal3,100);
            	}
			}
		});
	}
}

function actualizarFacultad(x){
	nombre = '';
	if(formRegistroFacultad())
	{
		id = x;
		if($('#nombre').length)		{	nombre 	= $('#nombre').val();}

		url = '../datos/actualizar_facultad.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{
				id:id, nombre:nombre},
			success: function(data)
			{
				$('#infoEditarFacultad').html(mostrarMensaje(listadoMensajes(data)));
				if(data == 3){
            		mostrarFacultades();
            		setTimeout(ocultarModal3,500);
            	}
			}
		});
	}
}

function mostrarFacultades(){
	$('#controlFacultades').html('<div class="container-fluid text-center d-flex align-items-center" style="height:150px;"><img src="../img/iconos/loading.gif" title="CARGANDO" width="100px" style="margin:auto"></div>');
	
	id = ''; nombre = ''
	if($('#b_id').length)				{	id 			= $('#b_id').val();}
	if($('#b_nombre').length)			{	nombre 	= $('#b_nombre').val();}
	url = 'control.php';
	$.ajax({
		type:"POST",
		url:url,
		data:{id:id, nombre:nombre},
		success: function(data)
		{$('#controlFacultades').html(data);}
	});
}

function borrarFacultad(x){
	url = '../datos/borrar_facultad.php';
	$.ajax({
		type:"POST",
		url:url,
		data:{id:x},
		success: function(data)
		{
			$('.modal-body').html(mostrarMensaje(listadoMensajes(data)));
            if(data == 4){
            	mostrarFacultades()
            	setTimeout(ocultarModal3,500);}
            else{$('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>')}
		}
	});
}

function ocultarModal3(){
	$('#modalFacultad').modal('toggle');
}