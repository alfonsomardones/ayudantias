$(document).ready(function() {
});


function formRegistroUsuario()
{
	bandera = true;
	nom = ''; ape = ''; rut = ''; fecha_nac = ''; sexo = '';
	tel = ''; correo = ''; tipo = ''; direccion = '';
	region = ''; comuna = ''; img = ''; estado = '';
	if($('#nombres').length){
		if (validarNombre($('#nombres').val()) == false)
		{
			bandera = false;
			$('#nombres').addClass('error');
		}
		else
		{
			if($('#nombres').hasClass('error'))
			{$('#nombres').removeClass('error');}
		}
	}
	if($('#apellidos').length){
		if (validarNombre($('#apellidos').val()) == false)
		{
			bandera = false;
			$('#apellidos').addClass('error');}
		else
		{
			if($('#apellidos').hasClass('error'))
			{$('#apellidos').removeClass('error');
	}
		}
	}
	if($('#rut').length){
		if (verificarRut($('#rut').val()) == false)
		{
			bandera = false;
			$('#rut').addClass('error');
		}
		else
		{
			if($('#rut').hasClass('error'))
			{$('#rut').removeClass('error');}
		}
	}
	if($('#correo').length){
		if (validarCorreo($('#correo').val()) == false)
		{
			bandera = false;
			$('#correo').addClass('error');
		}
		else
		{
			if($('#correo').hasClass('error'))
			{$('#correo').removeClass('error');}
		}
	}
	return bandera
}

function soloLetras(e){
	var key = e.charCode;
	if((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key==193 || key==201 || key==205 || key==211 || key==218) || (key==225 || key==233 || key==237 || key==243 || key==250) || (key== 196 || key== 203 || key== 207 || key== 214 || key== 220) || (key== 196 || key== 203 || key== 207 || key== 214 || key== 220) || (key==209 || key==241) || (key==0) || (key==46) || (key==32))	{}
	else{	return false;}
}


function soloLetrasNumeros(e){
	var key = e.charCode;
	if((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key==193 || key==201 || key==205 || key==211 || key==218) || (key==225 || key==233 || key==237 || key==243 || key==250) || (key== 196 || key== 203 || key== 207 || key== 214 || key== 220) || (key== 196 || key== 203 || key== 207 || key== 214 || key== 220) || (key==209 || key==241) || (key==46) || (key >= 48 && key <= 57) || (key==32))	{}
	else{	return false;}
}
function soloTexto(e){
	var key = e.charCode;
	if((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key==193 || key==201 || key==205 || key==211 || key==218) || (key==225 || key==233 || key==237 || key==243 || key==250) || (key== 196 || key== 203 || key== 207 || key== 214 || key== 220) || (key== 196 || key== 203 || key== 207 || key== 214 || key== 220) || (key==209 || key==241) || (key==0) || (key==46) || (key >= 48 && key <= 57) || (key==32) || (key==45) || (key==95))	{}
	else{	return false;}
}

function soloCorreoClave(e){
	var key = e.charCode;
	if((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || (key==0) || (key==46) || (key >= 48 && key <= 57) || (key==45) || (key==64) || (key==95))	{}
	else{	return false;}
}

function soloTelefono(e){
	var key = e.charCode;
	if((key >= 48 && key <= 57) || key==0 || key==43)	{}
	else{	return false;}
}


function validarNombre(x){
	if(x == null || x.length < 3 || x.length > 30 || /^\s+$/.test(x))
	{return false;}
 	else
 	{return true;}
}
function validarNumero(x){
	if(!isNaN(x))
	{return false;}
	else{return true;}
}
function validarTelefono(x){
	if(x == null || x.length == 0 || !(/^\d{8,12}$/.test(x)))
	{return false;}
	else
	{return true;}
}

function validarCorreo(x){
	if(x == null || x.length < 3 || x.length > 30 || !/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(x))
	{return false;}
	else
	{return true;}
}

function validarTitulo(x){
	var regex = /^[. a-zA-Z áÁéÉíÍïÏóÓöÖñÑ]+$/;
    return regex.test(x) ? true : false;
}

function validarTexto(x){
	var regex = /^[.-a-zA-Z0-9 -áÁéÉíÍïÏóÓöÖñÑ]+$/;
    return regex.test(x) ? true : false;
}

function validarClave(x){
	var regex = /^[.-_a-zA-Z 0-9]+$/;
    return regex.test(x) ? true : false;
}