$(document).ready(function() {
	mostrarInstituciones();
});

function modalInstitucion(tipo,dato){
	if(!dato)
	{dato = '';}
	$('#contenidoModalInstitucion').html('<div class="container-fluid text-center d-flex align-items-center" style="height:300px;"><img src="../img/iconos/loading.gif" title="CARGANDO" width="100px" style="margin:auto"></div>');
	titulo = ''; url = '';
	if(tipo==1)
	{
		if($('.modal-dialog').hasClass('modal-sm'))
			{$('.modal-dialog').removeClass('modal-sm')}
		$('.modal-dialog').addClass('modal-lg');
		titulo = 'REGISTRAR INSTUTICIÓN'; url = 'registrar.php';
		$.ajax({
			type:"POST",
			url:url,
			success: function(data)
			{$('#contenidoModalInstitucion').html(data);}
		});
	}
	else if(tipo==2)
	{
		if($('.modal-dialog').hasClass('modal-sm'))
			{$('.modal-dialog').removeClass('modal-sm')}
		$('.modal-dialog').addClass('modal-lg');
		titulo = 'EDITAR INSTUTICIÓN'; url = 'editar.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{id:dato},
			success: function(data)
			{$('#contenidoModalInstitucion').html(data);}
		});
	}
	else if(tipo==3)
	{
		titulo = 'BORRAR INSTUTICIÓN'; url = 'borrar.php';
		if($('.modal-dialog').hasClass('modal-lg'))
		{$('.modal-dialog').removeClass('modal-lg');}
		$.ajax({
			type:"POST",
			url:url,
			data:{id:dato},
			success: function(data)
			{$('#contenidoModalInstitucion').html(data);}
		});
	}
}

function registrarInstitucion(){
	nombre = ''; 
	if(formRegistroInstitucion())
	{
		if($('#nombre').length)		{	nombre 	= $('#nombre').val();}

		url = '../datos/registrar_institucion.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{
				nombre:nombre
			},
			success: function(data)
			{

				$('#infoRegistroInstitucion').html(mostrarMensaje(listadoMensajes(data)));
				if(data == 2){
            		mostrarInstituciones();
            		setTimeout(ocultarModal2,100);
            	}
			}
		});
	}
}

function actualizarInstitucion(x){
	nombre = '';
	if(formRegistroInstitucion())
	{
		id = x;
		if($('#nombre').length)		{	nombre 	= $('#nombre').val();}

		url = '../datos/actualizar_institucion.php';
		$.ajax({
			type:"POST",
			url:url,
			data:{
				id:id, nombre:nombre},
			success: function(data)
			{
				$('#infoEditarInstitucion').html(mostrarMensaje(listadoMensajes(data)));
				if(data == 3){
            		mostrarInstituciones();
            		setTimeout(ocultarModal2,500);
            	}
			}
		});
	}
}

function mostrarInstituciones(){
	id = ''; nombre = ''
	if($('#b_id').length)				{	id 			= $('#b_id').val();}
	if($('#b_nombre').length)			{	nombre 	= $('#b_nombre').val();}
	url = 'control.php';
	$.ajax({
		type:"POST",
		url:url,
		data:{id:id, nombre:nombre},
		success: function(data)
		{$('#controlInstituciones').html(data);}
	});
}

function borrarInstitucion(x){
	url = '../datos/borrar_institucion.php';
	$.ajax({
		type:"POST",
		url:url,
		data:{id:x},
		success: function(data)
		{
			$('.modal-body').html(mostrarMensaje(listadoMensajes(data)));
            if(data == 4){
            	mostrarInstituciones()
            	setTimeout(ocultarModal2,500);}
            else{$('.modal-footer').html('<button type="button" class="btn btn-secondary" data-dismiss="modal">SALIR</button>')}
		}
	});
}

function ocultarModal2(){
	$('#modalInstitucion').modal('toggle');
}