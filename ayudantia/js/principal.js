$(document).ready(function() {
	setInterval(nuevo_mensaje, 1000);
});

if (window.XMLHttpRequest) objAjax = new XMLHttpRequest() //para Mozilla
else if (window.ActiveXObject) objAjax = new ActiveXObject("Microsoft.XMLHTTP") //Para IExplorer
//---------------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
// SECCION 1 --------------------------------------------------------------------------------------
	// RELLENA MODAL CON FURMULARIOS DE SECCION 1
	function ObtenerModalSeccion1(x){
		document.getElementById("ModalPrincipio").innerHTML = "";
		$('#contenidoModal').html('<div id="divImg_cargando" align="center"><img src="img/loading.gif" alt="cargando" id="img_cargando"></div>');
		if(x==1)
		{
			document.getElementById("ModalPrincipio").innerHTML = "Iniciar Sesión";
			objAjax.open("POST","formularios/inicio_sesion.php"); 	//Abrir conexion
			objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			objAjax.send(null);	
			objAjax.onreadystatechange = MostrarResultadosSeccion1;
		}

		if(x==2)
		{
			document.getElementById("ModalPrincipio").innerHTML = "Registrar Usuario";
			objAjax.open("POST","formularios/registrar_usuario.php"); 	//Abrir conexion
			objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			objAjax.send(null);	
			objAjax.onreadystatechange = MostrarResultadosSeccion1;
		}
		if(x==3)
		{
			document.getElementById("ModalPrincipio").innerHTML = "Descargas";
			objAjax.open("POST","formularios/descargar.php"); 	//Abrir conexion
			objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			objAjax.send(null);	
			objAjax.onreadystatechange = MostrarResultadosSeccion1;
		}

		if(x==4)
		{
			document.getElementById("ModalPrincipio").innerHTML = "Contacto";
			objAjax.open("POST","formularios/contacto.php"); 	//Abrir conexion
			objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			objAjax.send(null);	
			objAjax.onreadystatechange = MostrarResultadosSeccion1;
		}

		if(x==5)
		{
			document.getElementById("ModalPrincipio").innerHTML = "Configurar cuenta";
			objAjax.open("POST","formularios/datos_usuario.php"); 	//Abrir conexion
			objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			objAjax.send(null);	
			objAjax.onreadystatechange = MostrarResultadosSeccion1;
		}

		if(x==6)
		{
			document.getElementById("ModalPrincipio").innerHTML = "Cerrar sesión";
			$('#contenidoModal').html('<p>¿Seguro que desea cerrar su sesión?</p><form action="datos/cerrar_sesion.php"><button type="submit" class="btn btn-warning btn-block">Cerrar sesión</button></form>');
		}
	}

	// MUESTRA RESULTADOS EN SECCION1
	function MostrarResultadosSeccion1()
	{	if (objAjax.readyState == 4)
		{	document.getElementById("contenidoModal").innerHTML = objAjax.responseText;	}
	}

	// REGISTRA AL USUARIO
	function RegistrarUsuario(){
		var nombres 	= document.getElementById("input_nombres").value;
		var apellidos 	= document.getElementById("input_apellidos").value;
		var rut 		= document.getElementById("input_rut").value;
		var fecha_nac 	= document.getElementById("input_fecha_nac").value;
		var telefono 	= document.getElementById("input_telefono").value;
		var tipo 		= document.getElementById("input_tipo").value;
		var correo 		= document.getElementById("input_correo").value;
		var clave 		= document.getElementById("input_clave").value;

		var url="datos/registrar_usuario.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{
				input_nombres:nombres, 		input_apellidos:apellidos, 	input_rut:rut, 			input_fecha_nac:fecha_nac,
				input_telefono:telefono, 	input_tipo:tipo, 			input_correo:correo,	input_clave:clave 		}});
	}

	function RegistrarAyudante(x){
		var id_usuario = x;
		if($("#input_institucion_carrera").length>0)
		{	var institucion_carrera = document.getElementById("input_institucion_carrera").value;
			alert("si existe institucion_carrera");	}
		else
		{	var institucion_carrera = 0;	}
		if($("#input_certificacion").length>0)
		{	var id_certificacion = document.getElementById("input_certificacion").value;
			alert("si existe certificacion");	}
		else
		{	var id_certificacion = 0;	}
		alert("id: "+id_usuario+" - institucion_carrera: "+institucion_carrera+" certificacion: "+id_certificacion);
		var url="datos/registrar_ayudante.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{
				input_id:id_usuario, input_institucion_carrera:institucion_carrera,input_certificacion:id_certificacion}});
	}

	function RegistrarAdminInstitucion(x){
		var id_usuario = x;
		var institucion = document.getElementById("input_institucion").value;
		var url="datos/registrar_admin_institucion.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{
				input_id:id_usuario, input_institucion:institucion}});
	}

	// COMPRUEBA FORMULARIO DE REGISTRAR
	function comprobar_registrar_usuario()
	{
		var verificar_nombres = false;
		var nombres = document.getElementById("input_nombres").value;
		document.getElementById("input_nombres").value = limpiar("nombres",nombres);
		nombres = document.getElementById("input_nombres").value;
		var respuesta = requisitos("nombres",nombres);
		if(respuesta[0]=='si')
		{
			verificar_nombres = true;
			if($("#alert-danger-nombres").length>0)
			{$("#alert-danger-nombres").slideUp(500);}
		}
		else
		{
			$('#errorNombres').html('<div id="alert-danger-nombres" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica nombres: </strong>'+respuesta[1]+'</div>');
			$("#alert-danger-nombres").fadeTo(2000, 500);
		}

		// APELLIDOS
		var verificar_apellidos = false;
		var apellidos = document.getElementById("input_apellidos").value;
		document.getElementById("input_apellidos").value = limpiar("apellidos",apellidos);
		apellidos = document.getElementById("input_apellidos").value;
		var respuesta = requisitos("apellidos",apellidos);
		if(respuesta[0]=='si')
		{	verificar_apellidos = true;	
			if($("#alert-danger-apellidos").length>0)
			{$("#alert-danger-apellidos").slideUp(500);}
		}
		else
		{
			$('#errorApellidos').html('<div id="alert-danger-apellidos" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica apellidos: </strong>'+respuesta[1]+'</div>');
			$("#alert-danger-apellidos").fadeTo(2000, 500);
		}
		// RUT
		var verificar_rut = false;
		var rut = document.getElementById("input_rut").value;
		document.getElementById("input_rut").value = limpiar("rut",rut);
		rut = document.getElementById("input_rut").value;
		var respuesta = requisitos("rut",rut);
		if(respuesta[0]=='si')
		{	var p = verificar('existe_rut',rut);
			if(p=='si')
			{
				$('#errorRut').html('<div id="alert-danger-rut" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica RUT: </strong>Ya está registrado.</div>');
				$("#alert-danger-rut").fadeTo(2000, 500);
			}
			else
			{ 	verificar_rut = true;	
				if($("#alert-danger-rut").length>0)
				{$("#alert-danger-rut").slideUp(500);}
			}
		}
		else
		{
			$('#errorRut').html('<div id="alert-danger-rut" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica RUT: </strong>'+respuesta[1]+'</div>');
			$("#alert-danger-rut").fadeTo(2000, 500);
		}

		// TELEFONO
		var verificar_telefono = false;
		var telefono = document.getElementById("input_telefono").value;
		document.getElementById("input_telefono").value = limpiar("telefono",telefono);
		telefono = document.getElementById("input_telefono").value;
		var respuesta = requisitos("telefono",telefono);
		if(respuesta[0]=='si')
		{	verificar_telefono = true;	
			if($("#alert-danger-telefono").length>0)
			{$("#alert-danger-telefono").slideUp(500);}
		}
		else
		{
			$('#errorTelefono').html('<div id="alert-danger-telefono" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica teléfono: </strong>'+respuesta[1]+'</div>');
			$("#alert-danger-telefono").fadeTo(2000, 500);
		}
		// CORREO
		var verificar_correo = false;
		var correo = document.getElementById("input_correo").value;
		var respuesta = requisitos("correo",correo);
		if(respuesta[0]=='si')
		{	var p = verificar('existe_correo',correo);
			if(p=='si')
			{
				$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>Ya está regitrado.</div>');
				$("#alert-danger-correo").fadeTo(2000, 500);
			}
			else
			{ verificar_correo = true;
				if($("#alert-danger-correo").length>0)
				{$("#alert-danger-correo").slideUp(500);}
			}
		}
		else
		{
			$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>'+respuesta[1]+'</div>');
			$("#alert-danger-correo").fadeTo(2000, 500);
		}

		// CONTRASEÑA
		var verificar_clave = false;
		var clave = document.getElementById("input_clave").value;
		var clave2 = document.getElementById("input_clave2").value;
		var respuesta = requisitos("clave",clave);
		if(clave!=clave2)
		{
			$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseña: </strong>No coinciden.</div>');
				$("#alert-danger-clave").fadeTo(2000, 500);
		}
		else
		{
			if(respuesta[0]=='si')
			{	verificar_clave = true;	
				if($("#alert-danger-clave").length>0)
				{
					$("#alert-danger-clave").slideUp(500);
				}
			}
			else
			{
				$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseña: </strong>'+respuesta[1]+'</div>');
				$("#alert-danger-clave").fadeTo(2000, 500);
			}
		}
		var verificar_tipo = false;
		var tipo = document.getElementById("input_tipo").value;
		if(tipo==1 || tipo == "1")
		{	var verificar_tipo = true;	}

		if(tipo == 2 || tipo == "2")
		{
			// SI EXISTEN LOS DOS ES PORQUE ERES ADMINISTRADOR
			if(($("#input_institucion").length>0 && $("#input_institucion_carrera").length>0))
			{
				if(document.getElementById("input_institucion_carrera").value!=0)
				{	verificar_tipo = true;
					alert("eres aministrador y correcto");	}
				else{
					verificar_tipo = false;
					alert("eres aministrador y false");
					$('#errorCarreras').html('<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica institución: </strong>Debe tener al menos una carrera asociada.</div>');
					$("#alert-danger-carrera").fadeTo(2000, 500);
				}
			}
			else
			{
				if(($("#input_institucion").length>0 && $("#input_institucion_carrera").length==0))
				{	verificar_tipo = false;
					alert("NO eres aministrador y false2");
					$('#errorCarreras').html('<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica institución: </strong>Debe tener al menos una carrera asociada.</div>');
					$("#alert-danger-carrera").fadeTo(2000, 500);		}
				else
				{	verificar_tipo = true;
					alert("NO eres aministrador y correcto2");		}
			}
		}
		if(tipo == 3 || tipo == "3")
		{
			if($("#input_institucion").length>0)
			{	var verificar_tipo = true;		}
			else
			{	var verificar_tipo = false;		}
		}
		if(tipo == 4 || tipo == "4")
		{	var verificar_tipo = true;		}

		if(verificar_nombres && verificar_apellidos && verificar_rut && verificar_correo && verificar_telefono && verificar_clave && verificar_tipo)
		{	RegistrarUsuario();
			if(tipo==2 || tipo=="2")
			{
				var id = verificar("obtener_id",rut);
				RegistrarAyudante(id);
			}
			if(tipo==3 || tipo=="3")
			{
				var id = verificar("obtener_id",rut);
				RegistrarAdminInstitucion(id);
			}
			if($("#alert-danger-clave").length>0)
			{ $("#alert-danger-clave").slideUp(500);
				document.getElementById("errorClave").innerHTML = "";
			}
			$('#errorClave').html('<div id="alert-success-clave" class="alert alert-success alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+document.getElementById("input_nombres").value+' '+document.getElementById("input_apellidos").value+'</strong> - Usuario registrado con <strong>éxito</strong>.</div>');
			$("#alert-success-clave").fadeTo(2000, 500);
		}
	}

	// ACTUALIZA DATOS DEL USUARIO
	function ActualizarUsuario(x,y){
		if(x==0)
		{	x = ''; }
		if(y==1) // SI RUT DESHABILITADO, SOLO TOMA LOS VALORES CORREO, CLAVE, TIPO, Y ESTADO
		{
			var id 			= document.getElementById("input_id"+x).value;
			var fecha_nac 	= document.getElementById("input_fecha_nac"+x).value;
			var telefono 	= document.getElementById("input_telefono"+x).value;
			var correo 		= document.getElementById("input_correo"+x).value;
			var tipo 		= document.getElementById("input_tipo"+x).value;
			var estado 		= document.getElementById("input_estado"+x).value;
			var url 		="datos/actualizar_usuario.php";
			$.ajax({
				type:"POST",
				url:url,
				data:{input_id:id, input_rut:"0", input_fecha_nac:fecha_nac,input_telefono:telefono, input_correo:correo,	input_tipo:tipo,input_estado:estado}
				});
		}
		else
		{
			var id 			= document.getElementById("input_id"+x).value;
			var nombres 	= document.getElementById("input_nombres"+x).value;
			var apellidos 	= document.getElementById("input_apellidos"+x).value;
			var rut 		= document.getElementById("input_rut"+x).value;
			var fecha_nac 	= document.getElementById("input_fecha_nac"+x).value;
			var telefono 	= document.getElementById("input_telefono"+x).value;
			var correo 		= document.getElementById("input_correo"+x).value;
			var tipo 		= document.getElementById("input_tipo"+x).value;
			var estado 		= document.getElementById("input_estado"+x).value;
			var url 		="datos/actualizar_usuario.php";
			$.ajax({
				type:"POST",
				url:url,
				data:{input_id:id,	input_nombres:nombres, 		input_apellidos:apellidos, 	input_rut:rut,		input_fecha_nac:fecha_nac,
					input_telefono:telefono,	input_correo:correo,	input_tipo:tipo,	input_estado:estado}
				});
		}
	}

	// COMPRUEBA FORMULARIO DATOS DE PERFIL
	function comprobar_actualizar_usuario(x){
		if(x=='0')
		{	x='';	}
		// NOMBRES
		var verificar_nombres = false;
		var nombres = document.getElementById("input_nombres"+x).value;
		document.getElementById("input_nombres"+x).value = limpiar("nombres",nombres);
		nombres = document.getElementById("input_nombres"+x).value;
		var respuesta = requisitos("nombres",nombres);
		if(respuesta[0]=='si')
		{	verificar_nombres = true;	}
		else
		{	}

		// APELLIDOS
		var verificar_apellidos = false;
		var apellidos = document.getElementById("input_apellidos"+x).value;
		document.getElementById("input_apellidos"+x).value = limpiar("apellidos",apellidos);
		apellidos = document.getElementById("input_apellidos"+x).value;
		var respuesta = requisitos("apellidos",apellidos);
		if(respuesta[0]=='si')
		{ 	verificar_apellidos = true; 	}
		else
		{	}

		// RUT
		var verificar_rut = false;
		var rut = document.getElementById("input_rut"+x).value;
		document.getElementById("input_rut"+x).value = limpiar("rut",rut);
		rut = document.getElementById("input_rut"+x).value;
		var respuesta = requisitos("rut",rut);
		if(respuesta[0]=='si')
		{	verificar_rut = true;	}
		else
		{ }

		// TELEFONO
		var verificar_telefono = false;
		var telefono = document.getElementById("input_telefono"+x).value;
		document.getElementById("input_telefono"+x).value = limpiar("telefono",telefono);
		telefono = document.getElementById("input_telefono"+x).value;
		var respuesta = requisitos("telefono",telefono);
		if(respuesta[0]=='si')
		{	verificar_telefono = true;	}
		else
		{ 	}

		// CORREO
		var verificar_correo = false;
		var correo = document.getElementById("input_correo"+x).value;
		var respuesta = requisitos("correo",correo);
		if(respuesta[0]=='si')
		{	verificar_correo = true;	}
		else
		{	}				

		var verificar_estado = false;
		var estado = document.getElementById("input_estado"+x).value;
		if((estado=="Habilitado") || (estado=="Bloqueado"))
		{	verificar_estado = true; }

		if(verificar_estado==false) 	{$("#input_estado"+x).focus();}
		if(verificar_correo==false) 	{$("#input_correo"+x).focus();}
		if(verificar_telefono==false) 	{$("#input_telefono"+x).focus();}
		if(verificar_rut==false) 		{$("#input_rut"+x).focus();}
		if(verificar_apellidos==false) 	{$("#input_apellidos"+x).focus();}
		if(verificar_nombres==false) 	{$("#input_nombres"+x).focus();}

		if(verificar_nombres && verificar_apellidos && verificar_rut && verificar_correo && verificar_telefono && verificar_estado)
		{	
			if($("#input_rut"+x).attr("disabled"))
			{ 	ActualizarUsuario(x,1);	}
			else
			{ 	ActualizarUsuario(x,0);	}
			if(x!='')
			{	BarraControl(1,1);	}
		}
	}

	// BORRA AL USUARIO
	function BorrarUsuario(x){
		var url="datos/borrar_usuario.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{cod:x}});
		BarraControl(1,1);
	}

	function Iniciar_sesion()
	{
		var usuario = document.getElementById("input_usuario").value;
		var clave = document.getElementById("input_clave").value;
		var url="datos/autenticacion.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{input_usuario:usuario, input_clave:clave},
			success: function()	{	
				window.location.href = "./";	} 
			});
	}

	// COMPRUEBA FORMULARIO INICIAR SESION
	function comprobar_iniciar_sesion()
	{
		var usuario 	= document.getElementById("input_usuario").value;
		var cadena = usuario.split("@");
		if(cadena.length==1)
		{
			usuario = limpiar("rut",usuario);
			document.getElementById("input_usuario").value = usuario;
		}
		var clave 		= document.getElementById("input_clave").value;
		if(usuario.length>0 && clave.length>0)
		{	var u = verificar('existe_usuario', usuario);
			if (u=='si')
			{	var c = verificar('clave_de_usuario', usuario+"/"+clave);
				if(c=='si')
				{	var b = verificar('usuario_habilitado',usuario);
					if(b=='si')
					{	Iniciar_sesion();	
						if($("#alert-danger-iniciar").length>0)
							{	$("#alert-danger-iniciar").slideUp(500);}
					}
					else
					{
						alert("usuario no habilitado, enviar a funcion iniciar sesion");
						$('#errorIniciarSesion').html('<div id="alert-danger-iniciar" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica usuario: </strong>Inhabilitado.</div>');
						$("#alert-danger-iniciar").fadeTo(2000, 500);
					}
				}
				else
				{
					$("#input_clave").focus();
					$('#errorIniciarSesion').html('<div id="alert-danger-iniciar" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica usuario: </strong>Datos no coinciden.</div>');
						$("#alert-danger-iniciar").fadeTo(2000, 500);
				}
			}
			else
			{
				$("#input_usuario").focus();
				$('#errorIniciarSesion').html('<div id="alert-danger-iniciar" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica usuario: </strong>No registrado.</div>');
				$("#alert-danger-iniciar").fadeTo(2000, 500);
			}
		}
		else
		{
			$('#errorIniciarSesion').html('<div id="alert-danger-iniciar" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica usuario: </strong>Complete los campos.</div>');
			$("#alert-danger-iniciar").fadeTo(2000, 500);
			if(usuario.length==0) {$("#input_usuario").focus();}
			else{$("#input_clave").focus();}
		}
	}

	// VERIFICA EXISTENCIA DE DATOS, RETORNA SI O NO
	function verificar(tipo, dato){
		var respuesta = null;
		var url="datos/verificar_dato.php";
		$.ajax({
			async: false,	type:"POST",	url:url, 	data:{input_tipo:tipo, input_dato:dato},
			success: function(data)
			{	respuesta = data;		}
		})
		return respuesta;
	}

	function obtenerdato_BD(tipo, dato){
		var respuesta = null;
		var url="datos/obtener_dato.php";
		$.ajax({
			async: false,	type:"POST",	url:url, 	data:{input_tipo:tipo, input_dato:dato},
			success: function(data)
			{	respuesta = data;		}
		})
		return respuesta;
	}

	function limpiar(tipo,dato)
	{
		if(tipo=="rut")
		{
			rut = dato;
			rut = rut.trim();
			var patron = /[a-z A-Z áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ.-]/g;
			rut = rut.replace(patron,"");
			if(rut.length>1)
			{
				rut = rut.substring(0,rut.length-1)+"-"+rut.substring(rut.length-1)
			}
			dato = rut;
		}
		if(tipo=="telefono")
		{
			telefono = dato;
			telefono = telefono.trim();
			var patron = /[a-z A-Z áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ.-]/g;
			telefono = telefono.replace(patron,"");
			dato = telefono;
		}
		if(tipo=="nombres" || tipo=="apellidos")
		{
			var nombres = dato;
			var cadena = [];
			nombres = nombres.trim();
			cadena = nombres.split(" ");
			for(i=0;i<cadena.length;i++)
			{
				cadena[i] = cadena[i].charAt(0).toUpperCase() + cadena[i].substring(1).toLowerCase();
			}
			nombres = cadena.join(" ");
			dato = nombres;
		}
		if(tipo=="carrera" || tipo=="institucion")
		{
			var nombres = dato;
			nombres = nombres.trim();
			nombres = nombres.toUpperCase();
			dato = nombres;
		}
		if(tipo=="texto")
		{
			dato = dato.trim();
		}
		return dato;
	}
	
	function requisitos(tipo, dato){
		var respuesta = ["",""];
		if(tipo=='nombres' || tipo=='apellidos' || tipo=='carrera' || tipo=='institucion')
		{
			nombre = dato;
			if(nombre.length==0)
			{	respuesta = ["no","No hay datos."];	}
			else
			{
				if(nombre.length>2 && nombre.length<30)
				{
					// VERIFICAR SOLO CARACTERES VALIDOS
					if(tipo == "institucion") { 	patron=/^[a-z A-Z 0-9 áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ]{2,30}$/; }
					else {	patron=/^[a-z A-Z áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ]{2,30}$/; }
					if (patron.test(nombre.trim()))
					{	respuesta = ["si",""];	}
					else
					{	respuesta = ["no","No cumple requisitos."]; }
				}
				else
				{	respuesta = ["no","Cantidad de datos incorrecta."];	}
			}
		}
	
		if(tipo=='rut')
		{
			rut = dato;
			if(rut.length==0)
			{	respuesta = ["no","No hay datos."];		}
			else
			{
				if(rut.length>8 && rut.length<11)
				{
					patron=/^[0-9-]{2,10}$/;
					if (patron.test(rut.trim()))
					{	respuesta = ["si",""];	}
					else
					{	respuesta = ["no","No cumple requisitos."];		}
				}
				else
				{	respuesta = ["no","Cantidad de datos incorrecta."];	}
			}
		}

		if (tipo=='telefono')
		{
			telefono = dato;
			if(telefono.length==0)
			{	respuesta = ["no","No hay datos."];		}
			else
			{
				if(telefono.length>7 && telefono.length<11)
				{
					// VERIFICAR SOLO CARACTERES VALIDOS
					patron=/^[0-9]{8,11}$/;
					if (patron.test(telefono.trim()))
					{	respuesta = ["si",""];		}
					else
					{	respuesta = ["no","No cumple requisitos."];		}
				}
				else
				{	respuesta = ["no","Cantidad de datos incorrecta."];	}
			}
		}

		if(tipo=='correo')
		{
			correo = dato;
			if (correo.length==0)
			{	respuesta = ["no","No hay datos."];		}
			else
			{
				var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
				if (regex.test(correo.trim())) 
				{ 	respuesta = ["si",""];		}
				else
				{	respuesta = ["no","No cumple requisitos."];		}

			}
		}

		if(tipo=='clave')
		{	
			clave = dato;
			if(clave.length==0)
			{	respuesta = ["no","No hay datos."];		}
			else
			{
				if(clave.length>4 && clave.length<20)
				{
					// VERIFICAR SOLO CARACTERES VALIDOS
					patron=/^[a-zA-Z0-9._%+-]{4,30}$/;
					if (patron.test(clave.trim()))
					{	respuesta = ["si",""];		}
					else
					{	respuesta = ["no","No cumple requisitos."];		}
				}
				else
				{	respuesta = ["no","Cantidad de datos incorrecta."];	}
			}
		}
		if(tipo=='texto')
		{
			if(dato.length==0)
			{	respuesta = ["no","No hay datos."];	}
			else
			{
				if(dato.length>2 && dato.length<30)
				{
					// VERIFICAR SOLO CARACTERES VALIDOS
					patron=/^[a-z A-Z 0-9 áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ]{3,200}$/; 
					if (patron.test(dato.trim()))
					{	respuesta = ["si",""];	}
					else
					{	respuesta = ["no","No cumple requisitos."]; }
				}
				else
				{	respuesta = ["no","Cantidad de datos incorrecta."];	}
			}
		}
		return respuesta;
	}

// SECCION 2 -------------------------------------------------------------------------------------
// SECCION 2 -------------------------------------------------------------------------------------
// SECCION 2 -------------------------------------------------------------------------------------
// SECCION 2 -------------------------------------------------------------------------------------
// SECCION 2 -------------------------------------------------------------------------------------
// SECCION 2 -------------------------------------------------------------------------------------
// SECCION 2 -------------------------------------------------------------------------------------
// SECCION 2 -------------------------------------------------------------------------------------

	//  bBARRA CONTROL
	function BarraControl(x,y)
	{
		$('#contenedorSeccion2').html("<div id='tituloControl'><h2 id='textoTitulo'></h2></div><div id='cuerpoControl'></div>");
		$('#cuerpoControl').html('<div id="divImg_cargando" align="center"><img src="img/loading.gif" alt="cargando" id="img_cargando"></div>');
		if(x=='1')
		{
			if(y=='1')
			{
				var titulo = "Control de Usuarios";
				objAjax.open("POST","formularios/control_usuarios.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);
				document.getElementById("ModalPrincipio").innerHTML = "";
			}
			if(y=='2')
			{
				var titulo = "Registrar Usuario";
				objAjax.open("POST","formularios/registrar_usuario.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);	
			}
		}
		if(x=='2')
		{
			if(y=='1')
			{
				var titulo = "Control de Ayudantes";
				objAjax.open("POST","formularios/control_ayudantes.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);
			}
		}
		if(x=='3')
		{
			if(y=='1')
			{
				var titulo = "Control de Instituciones";
				objAjax.open("POST","formularios/control_instituciones.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);	
			}

			if(y=='2')
			{
				var titulo = "Registrar Institución";
				objAjax.open("POST","formularios/registrar_institucion.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);	
			}
			if(y=='5')
			{
				var titulo = "Control de Administradores";
				objAjax.open("POST","formularios/control_administradores_instituciones.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);	
			}
		}

		if(x=='4')
		{
			if(y=='1')
			{
				var titulo = "Control Carreras";
				objAjax.open("POST","formularios/control_carreras.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);	
			}

			if(y=='2')
			{
				var titulo = "Registrar Carrera";
				objAjax.open("POST","formularios/registrar_carrera.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);	
			}
		}
		if(x=='10')
		{
			if(y=='1')
			{
				var titulo = "Mensajes";
				objAjax.open("POST","formularios/mensajes.php"); 	//Abrir conexion
				objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				objAjax.send(null);	
			}
		}
		document.getElementById("textoTitulo").innerHTML = titulo;
		objAjax.onreadystatechange = MostrarResultadosSeccion2;
	}


	function MostrarResultadosSeccion2()
	{	if (objAjax.readyState == 4)
		{	document.getElementById("cuerpoControl").innerHTML = objAjax.responseText;	}
	}

	// PERMITE BUSCAR A LOS USUARIOS POR CAMPOS DE LA TABLA
	function FiltroUsuarios() {
		var valor;
		var tipo = document.getElementById("tipoBuscarUsuario").value;
		if(tipo=="id") 	{ valor = 0;}
		if(tipo=="nombres") 	{ valor = 1;}
		if(tipo=="apellidos") 	{ valor = 2;}
		if(tipo=="rut") 		{ valor = 3;}
		var input, filter, table, tr, td, i;
		input = document.getElementById("FiltroUsuarios");
		filter = input.value.toUpperCase();
		table = document.getElementById("TablaUsuarios");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[valor];
		    if (td) {
			    if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
			   	{
			       	tr[i].style.display = "";
			    }
		      	else
		      	{
		        	tr[i].style.display = "none";
		        }
		    }       
		}
	}


	// FILTRO INSTITUCIONES
	function FiltroInstituciones() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("FiltroInstituciones");
		filter = input.value.toUpperCase();
		table = document.getElementById("TablaInstituciones");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
		    if (td) {
			    if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
			   	{
			       	tr[i].style.display = "";
			    }
		      	else
		      	{
		        	tr[i].style.display = "none";
		        }
		    }       
		}
	}

	// FILTRO CARRERAS
	function FiltroCarreras() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("FiltroCarreras");
		filter = input.value.toUpperCase();
		table = document.getElementById("TablaCarreras");
		tr = table.getElementsByTagName("tr");
		for (i = 0; i < tr.length; i++) {
			td = tr[i].getElementsByTagName("td")[0];
		    if (td) {
			    if (td.innerHTML.toUpperCase().indexOf(filter) > -1)
			   	{
			       	tr[i].style.display = "";
			    }
		      	else
		      	{
		        	tr[i].style.display = "none";
		        }
		    }       
		}
	}

// INSTITUCIONES 
	function RegistrarInstitucion(){
		var nombre 	= document.getElementById("input_nombre").value;
		var url="datos/registrar_institucion.php";
		$.ajax({
			type:"POST", url:url, data:{	input_nombre:nombre}	});
		BarraControl(3,1);
	}

	function comprobar_registrar_institucion(){
		// NOMBRES
		var verificar_nombre = false;
		var nombre = document.getElementById("input_nombre").value;
		document.getElementById("input_nombre").value = limpiar("institucion",nombre);
		nombre = document.getElementById("input_nombre").value;
		var respuesta = requisitos("institucion",nombre);
		if(respuesta[0]=='si')
		{	
			var p = verificar('existe_institucion', nombre);
			if(p=='si')
			{
				$("#input_nombre").focus();
				$('#errorInstitucion').html('<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica institución: </strong>Ya está registrada.</div>');
				$("#alert-danger-institucion").fadeTo(2000, 500);
			}
			else
			{	verificar_nombre = true;
				if($("#alert-danger-institucion").length>0)
				{ $("#alert-danger-institucion").slideUp(500);	}
			}
		}
		else
		{
			$("#input_nombre").focus();
			$('#errorInstitucion').html('<div id="alert-danger-institucion" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica institución: </strong>'+respuesta[1]+'</div>');
				$("#alert-danger-institucion").fadeTo(2000, 500);
		}

		if(verificar_nombre)
		{	RegistrarInstitucion();
			if($("#alert-danger-institucion").length>0)
			{ $("#alert-danger-institucion").slideUp(500);
				document.getElementById("errorInstitucion").innerHTML = "";	}
			$('#errorInstitucion').html('<div id="alert-success-institucion" class="alert alert-success alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+document.getElementById("input_nombre").value+'</strong> - Institución registrada con <strong>éxito</strong>.</div>');
			$("#alert-success-institucion").fadeTo(2000, 500);
			document.getElementById("input_nombre").value = "";
		}
	}

	function comprobar_actualizar_institucion(x){
		// NOMBRES
		var id_institucion = x;
		var verificar_nombre = false;
		var nombre = document.getElementById("input_nombre"+id_institucion).value;
		document.getElementById("input_nombre"+id_institucion).value = limpiar("institucion",nombre);
		nombre = document.getElementById("input_nombre"+id_institucion).value;
		if(nombre.length==0)
		{
			$("#input_nombre"+x).focus();
		}
		else
		{
			if(nombre.length>2 && nombre.length<30)
			{
				// VERIFICAR SOLO CARACTERES VALIDOS
				patron=/^[a-z A-Z áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ.-]{2,30}$/;
				if (patron.test($('#input_nombre'+id_institucion).val().trim()))
				{
					// EXISTE INSTITUCION?
					var p = verificar('existe_institucion',nombre);
					if(p=='si')
					{
						// ESA INSTITUCION CORRESPONDE A ESTE ID?
						var p = verificar('cambie_nombre_institucion',nombre+"/"+id_institucion);
						if(p=='si')
						{	}
						else
						{	verificar_nombre = true;	}
					}
					else
					{	verificar_nombre = true;	}
				}
				else
				{	}
			}
			else
			{	}
		}

		if(verificar_nombre)
		{	ActualizarInstitucion(id_institucion);	}
	}

	function ActualizarInstitucion(x){
		var id_institucion = x;
		var nombre 				= document.getElementById("input_nombre"+x).value;
		var logo_institucion = "-";
		var url="datos/actualizar_institucion.php";
		$.ajax({
			type:"POST", url:url, 
				data:{ input_id:x, input_nombre:nombre, input_logo_institucion:logo_institucion}
		});
		BarraControl(3,1);
	}

	function BorrarInstitucion(x){
		var url="datos/borrar_institucion.php";
		$.ajax({
			type:"POST", url:url,	data:{ cod:x}});
		BarraControl(3,1);
	}


	// CARRERAS
	function RegistrarCarrera(){
		var nombre 	= document.getElementById("input_nombre").value;
		var url="datos/registrar_carrera.php";
		$.ajax({
			type:"POST", url:url, data:{ input_nombre:nombre }	});
		BarraControl(4,1);
	}

	function comprobar_registrar_carrera(){
		// NOMBRES
		var verificar_nombre = false;
		var nombre = document.getElementById("input_nombre").value;
		document.getElementById("input_nombre").value = limpiar("carrera",nombre);
		nombre = document.getElementById("input_nombre").value;
		var respuesta = requisitos("carrera",nombre);
		if(respuesta[0]=='si')
		{	
			var p = verificar('existe_carrera', nombre);
			if(p=='si')
			{	$("#input_nombre").focus();
				$('#errorCarrera').html('<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica carrera: </strong>Ya existe.</div>');
				$("#alert-danger-carrera").fadeTo(2000, 500);
			}
			else
			{ 
				verificar_nombre = true; 
				if($("#alert-danger-carrera").length>0)
				{	$("#alert-danger-carrera").slideUp(500);}
			}
		}
		else
		{
			$("#input_nombre").focus();
			$('#errorCarrera').html('<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica carrera: </strong>'+respuesta[1]+'</div>');
				$("#alert-danger-carrera").fadeTo(2000, 500);
		}

		if(verificar_nombre)
		{	RegistrarCarrera(); 	
			if($("#alert-danger-carrera").length>0)
			{ $("#alert-danger-carrera").slideUp(500);
				document.getElementById("errorCarrera").innerHTML = "";
			}
			$('#errorCarrera').html('<div id="alert-success-carrera" class="alert alert-success alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>'+document.getElementById("input_nombre").value+'</strong> - Carrera registrada con <strong>éxito</strong>.</div>');
			$("#alert-success-carrera").fadeTo(2000, 500);
			document.getElementById("input_nombre").value = "";
		}
	}

	function comprobar_actualizar_carrera(x){
		// NOMBRES
		var id_carrera = x;
		var verificar_nombre = false;
		var nombre = document.getElementById("input_nombre"+id_carrera).value;
		document.getElementById("input_nombre"+id_carrera).value = limpiar("carrera",nombre);
		nombre = document.getElementById("input_nombre"+id_carrera).value;
		var respuesta = requisitos("carrera",nombre);
		if(respuesta[0]=='si')
		{	verificar_nombre=true; }
		else
			{ $("#input_nombre"+x).focus();}
		if(verificar_nombre)
		{	ActualizarCarrera(id_carrera);	}
	}

	function ActualizarCarrera(x){
		var id_carrera = x;
		var nombre 	= document.getElementById("input_nombre"+x).value;
		var url="datos/actualizar_carrera.php";
		$.ajax({
			type:"POST", url:url, data:{ input_id:x, input_nombre:nombre}, success: function(){	}
		});
		BarraControl(4,1);
	}

	function BorrarCarrera(x){
		var url="datos/borrar_carrera.php";
		$.ajax({
			type:"POST", url:url, data:{ cod:x}});
		BarraControl(4,1);
	}

	function advertirModificaciones(tabla,x)
	{	
		var id = x;
		if(tabla=="TablaInstituciones")
		{
			var nombre = document.getElementById("input_nombre"+id).value;
			var nombre2 = document.getElementById("input_nombre2"+id).value;
			var logo_institucion = document.getElementById("input_logo_institucion"+id).value;
			var logo_institucion2 = document.getElementById("input_logo_institucion2"+id).value;
			var logo_certificacion =  document.getElementById("input_logo_certificacion"+id).value;
			var logo_certificacion2 = document.getElementById("input_logo_certificacion2"+id).value;

			$("#filaTablaInstitucion"+id).addClass("warning");
		}
		if(tabla=="TablaCarreras")
		{
			var nombre = document.getElementById("input_nombre"+id).value;
			var nombre2 = document.getElementById("input_nombre2"+id).value;
			if(nombre!=nombre2)
			{	$("#filaTablaCarrera"+id).addClass("warning");	}
			else
			{	$("#filaTablaCarrera"+id).removeClass("warning");	}
		}

		if(tabla=="TablaUsuarios")
		{
			var nombre = document.getElementById("input_nombre"+id).value;
			var nombre2 = document.getElementById("input_nombre2"+id).value;
			if(nombre!=nombre2)
			{	$("#filaTablaUsuario"+id).addClass("warning");	}
			else
			{	$("#filaTablaUsuario"+id).removeClass("warning");	}
		}
	}

	function obtenerSelect(tipo,dato)
	{
		var respuesta = null;
		var url="datos/select_option.php";
		if(tipo=="instituciones")
		{
			$.ajax({
			async: false,	type:"POST",	url:url, 	data:{input_tipo:tipo},
			success: function(data)	{	respuesta = data;		}	});
		}
		if(tipo=="carreras")
		{
			$.ajax({
			async: false,	type:"POST",	url:url, 	data:{input_tipo:tipo},
			success: function(data)	{	respuesta = data;		}	});
		}
		if(tipo=="institucion_carrera")
		{
			var dato = document.getElementById("input_institucion").value;
			$.ajax({
			async: false,	type:"POST",	url:url, 	data:{input_tipo:tipo, input_dato:dato},
			success: function(data)	{	respuesta = data;		}	});
		}
		return respuesta;
	}

	function listarIntituciones()
	{
		if(document.getElementById("input_tipo").value==2 || document.getElementById("input_tipo").value=="2")
		{
			$('#divInstituciones').html('<div class="form-group"><label for="input_institucion">Institución:</label><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-education"></span></span><select id="input_institucion" onchange="listarCarrerasAsociadas()" class="form-control">'+obtenerSelect("instituciones",0)+'</select></div></div>');
			listarCarrerasAsociadas();
		}
		if(document.getElementById("input_tipo").value==3 || document.getElementById("input_tipo").value=="3")
		{
			$('#divInstituciones').html('<div class="form-group"><label for="input_institucion">Institución:</label><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-education"></span></span><select id="input_institucion" class="form-control">'+obtenerSelect("instituciones",0)+'</select></div></div>');
		}
		else
		{
			document.getElementById("divInstituciones").innerHTML="";
			document.getElementById("divCarreras").innerHTML="";
		}
	}

	function listarCarrerasAsociadas()
	{
		if(document.getElementById("input_tipo").value==2 || document.getElementById("input_tipo").value=="2")
		{
			//alert(obtenerSelect("institucion_carrera",document.getElementById("input_institucion").value));
			$('#divCarreras').html('<div class="form-group"><label for="input_institucion_carrera">Carrera:</label><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></span><select id="input_institucion_carrera" class="form-control">'+obtenerSelect("institucion_carrera",document.getElementById("input_institucion").value)+'</select></div></div>');
			if(document.getElementById("input_institucion_carrera").value==0)
			{
				document.getElementById("divCarreras").innerHTML = "";
				$('#errorCarreras').html('<div id="alert-danger-carrera" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica Institución: </strong>Debe tener al menos una carrera asociada.</div>');
				$("#alert-danger-carrera").fadeTo(2000, 500);
			}
			else
			{
				if($("#alert-danger-carrera").length>0)
				{	$("#alert-danger-carrera").slideUp(500);	}
			}
		}
		else
		{
			document.getElementById("divInstituciones").innerHTML ="";
			document.getElementById("divCarreras").innerHTML ="";
		}
	}

	
	function desasociar_institucion_carrera(x)
	{
		objAjax.open("POST","datos/borrar_institucion_carrera.php"); 	//Abrir conexion
		objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		objAjax.send('cod='+x);
	}

	function comprobar_mensaje()
	{
		var remitente 	= document.getElementById("input_remitente").value;
		var verificar_remitente = false;
		var respuesta = requisitos("correo",remitente);
		if(respuesta[0]=="si")
		{	var verificar_remitente = true;		}
		else
		{	alert(respuesta[1]);	}

		var mensaje 	= document.getElementById("input_mensaje").value;
		mensaje = limpiar("texto",mensaje);
		var verificar_mensaje = false;
		var respuesta = requisitos("texto",mensaje);
		if(respuesta[0]=="si")
		{	var verificar_mensaje = true;	}
		
		if(verificar_remitente && verificar_mensaje)
		{	enviar_mensaje();	}
	}

	function enviar_mensaje()
	{
		var remitente 	= document.getElementById("input_remitente").value;
		var recibe 		= document.getElementById("input_recibe").value;
		var tipo 		= document.getElementById("input_tipo").value;
		var mensaje 	= document.getElementById("input_mensaje").value;

		var url="datos/registrar_mensaje.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{input_remitente:remitente, input_recibe:recibe, input_tipo:tipo, 	input_mensaje:mensaje}});
	}

	function nuevo_mensaje()
	{
		if($('#seccion1-mensajes').length>0)
		{
			//$('#idenNuevoMsj').html('<span class="badge badge-pill badge-warning">'+nuevo+'</span>');
			var nuevo = verificar("nuevo_mensaje");
			var usuario = verificar("nombre_usuario");
			if(nuevo!=0 || nuevo!="0")
			{
				var texto1 = 'Mensajes <span class="badge badge-pill badge-warning">'+nuevo+'</span>';	
				var texto2 = usuario+' <span class="badge badge-pill badge-warning"><span class="glyphicon glyphicon-envelope"></span></span>';
			}
			else
			{	
				var texto1 = "Mensajes"
				var texto2 = usuario;
			}
			document.getElementById('seccion1-mensajes').innerHTML = texto1;
			document.getElementById('btn-InicioSesion').innerHTML = texto2;
		}
	}

	function desasociar_ayudante(x)
	{
		var id 	= x;

		var url="datos/desasociar_ayudante.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{input_id:id}});
		BarraControl(2,1);
	}

	function borrarAyudante(x)
	{
		var id 	= x;

		var url="datos/borrar_ayudante.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{input_id:id}});
		BarraControl(2,1);
	}

	function BorrarAdminInstitucion(x)
	{
		var id 	= x;
		var url = "datos/borrar_admin_institucion.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{input_id:id}});
		BarraControl(3,5);
	}

	function listarMensajes(x)
	{
		var usuario = x;
		var url = "datos/listar_mensajes.php";
		$.ajax({
			async: false,	type:"POST",	url:url, 	data:{input_id:usuario},
			success: function(data)	{	respuesta = data;		}	});
		document.getElementById('contenidoMensaje').innerHTML = respuesta;
	}

	function actualizar_ayudante(x,y,z)
	{
		var id_usuario 	= x;
		var id_ayudante = y;
		var id_institucion = z;
		var estado 				= document.getElementById('input_estado'+x).value;
		var id_carrera 			= document.getElementById('input_carrera'+x).value;
		var id_certificacion 	= document.getElementById('input_certificacion'+x).value;
		var url = "datos/actualizar_ayudante.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{input_id:id_usuario, input_id_ayudante:id_ayudante, input_estado:estado, input_institucion:id_institucion, input_carrera:id_carrera, input_certificacion:id_certificacion}});
		BarraControl(2,1);
	}