$(document).ready(function() {
	opcionesTipoUsuario();
});

function opcionesTipoUsuario(x,y){
	if(!x){x='';}
	tipo = '';
	if($(x).length){ tipo = $(x).val();}
	$('#infoOtrosDatos').html('');
	if(tipo!='')
	{
		opcionesEstado(tipo)
		if(tipo==1 || tipo == 4)
		{
			$('#infoOtrosDatos').html('<div class="col-12"><div class="alert alert-success alert-dismissible fade show" role="alert">USUARIO NO REQUIERE OTROS DATOS<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></div>');
		}
		else if(tipo==2 || tipo==3)
		{
			url = 'list_instituciones.php';
			$.ajax({type:"POST",url:url,data:{id:y},success: function(data){$('#infoOtrosDatos').html('<div class="col-6">'+data+'</div>');}});

			url = 'list_unidades.php';
			$.ajax({type:"POST",url:url,data:{id:y},success: function(data){$('#infoOtrosDatos').append('<div class="col-6">'+data+'</div>');}});
			
		}
		else if(tipo==5)
		{

		}
		else
		{
			$('#infoOtrosDatos').html('<div class="col-12"><div class="alert alert-danger alert-dismissible fade show" role="alert">ERROR EN EL TIPO DE USUARIO<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></div>');
		}

	}
	else
	{
		$('#infoOtrosDatos').html('<div class="col-12"><div class="alert alert-warning alert-dismissible fade show" role="alert">DEBE SELECCIONAR EL TIPO DE USUARIO<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div></div>');
	}
}

function formAdminInstitucion(){
	bandera = true;
	if($('#instituciones').length){
		bandera = false;
		institucion = $('#instituciones').val();
		if($(institucion!='' && validarNumero(institucion))){
			bandera = true;
		}
	}

	if($('#unidades').length){
		bandera = false;
		unidad = $('#unidades').val();
		if($(unidad!='' && validarNumero(unidad))){
			bandera = true;
		}
	}
	return bandera;
}

function opcionesEstado(x){
	if(x==1 || x==2 || x == 3){$('#estado').html('<option value="HABILITADO" selected="">HABILITADO</option><option value="DESHABILITADO">DESHABILITADO</option>');}
	else{$('#estado').html('<option value="PENDIENTE" selected="">PENDIENTE</option><option value="HABILITADO">HABILITADO</option><option value="DESHABILITADO">DESHABILITADO</option>');}
}