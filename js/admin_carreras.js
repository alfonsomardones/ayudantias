$(document).ready(function() {
	mostrarCarreras();
});

function modalCarrera(tipo,dato){
	if(!dato)
	{dato = '';}
	$('#contenidoModalCarrera').html('<div class="container-fluid text-center d-flex align-items-center" style="height:300px;"><img src="../img/iconos/loading.gif" title="CARGANDO" width="100px" style="margin:auto"></div>');
	titulo = ''; url = '';
	if(tipo==1)
	{
		if($('.modal-dialog').hasClass('modal-sm'))
			{$('.modal-dialog').removeClass('modal-sm')}
		$('.modal-dialog').addClass('modal-lg');
		titulo = 'REGISTRAR CARRERA'; url = 'registrar.php';
		$.ajax({
			type:"POST",
			url:url,
			success: function(data)
			{$('#contenidoModalCarrera').html(data);}
		});
	}
	else if(tipo==2)
	{
		if($('.modal-dialog').hasClass('modal-sm'))
			{$('.modal-dialog').removeClass('modal-sm')}
		$('.modal-dialog').addClass('modal-lg');
		titulo = 'EDITAR CARRERA'; url = 'editar.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{id:dato},
			success: function(data)
			{$('#contenidoModalCarrera').html(data);}
		});
	}
	else if(tipo==3)
	{
		titulo = 'BORRAR CARRERA'; url = 'borrar.php';
		if($('.modal-dialog').hasClass('modal-lg'))
		{$('.modal-dialog').removeClass('modal-lg');}
		$.ajax({
			type:"POST",
			url:url,
			data:{id:dato},
			success: function(data)
			{$('#contenidoModalCarrera').html(data);}
		});
	}
}

function registrarCarrera(){
	nombre = ''; 
	if(formRegistroCarrera())
	{
		if($('#nombre').length)		{	nombre 	= $('#nombre').val();}

		url = '../datos/registrar_carrera.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{nombre:nombre},
			success: function(data)
			{
				$('#infoRegistroCarrera').html(mostrarMensaje(listadoMensajes(data)));
				if(data == 2){
            		mostrarCarreras();
            		setTimeout(ocultarModal4,100);
            	}
			}
		});
	}
}

function actualizarCarrera(x){
	nombre = '';
	if(formRegistroCarrera())
	{
		id = x;
		if($('#nombre').length)		{	nombre 	= $('#nombre').val();}

		url = '../datos/actualizar_carrera.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{
				id:id, nombre:nombre},
			success: function(data)
			{
				$('#infoEditarCarrera').html(mostrarMensaje(listadoMensajes(data)));
				if(data == 3){
            		mostrarCarreras();
            		setTimeout(ocultarModal4,500);
            	}
			}
		});
	}
}

function mostrarCarreras(){
	id = ''; nombre = ''
	if($('#b_id').length)				{	id 			= $('#b_id').val();}
	if($('#b_nombre').length)			{	nombre 	= $('#b_nombre').val();}
	url = 'control.php';
	$.ajax({
		type:"POST",
		url:url,
		data:{id:id, nombre:nombre},
		success: function(data)
		{$('#controlCarreras').html(data);}
	});
}

function borrarCarrera(x){
	url = '../datos/borrar_carrera.php';
	$.ajax({
		type:"POST",
		url:url,
		data:{id:x},
		success: function(data)
		{
			$('.modal-body').html(mostrarMensaje(listadoMensajes(data)));
            if(data == 4){
            	mostrarCarreras()
            	setTimeout(ocultarModal4,500);}
            else{$('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>')}
		}
	});
}

function ocultarModal4(){
	$('#modalCarrera').modal('toggle');
}