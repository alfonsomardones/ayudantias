$(document).ready(function() {
	verificar_existencia();
});

if (window.XMLHttpRequest) objAjax = new XMLHttpRequest() //para Mozilla
else if (window.ActiveXObject) objAjax = new ActiveXObject("Microsoft.XMLHTTP") //Para IExplorer

// SECCION 1
	function ObtenerModalSeccion1(x){
		document.getElementById("ModalPrincipio").innerHTML = "";
		document.getElementById("contenidoModal").innerHTML = "";
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
			$('#contenidoModal').html('<p>¿Seguro que desea cerrar su sesión?</p><form action="datos/cerrar_sesion.php"><button type="submit" class="btn btn-primary">Cerrar sesión</button></form>');
		}
	}

	function MostrarResultadosSeccion1()
	{	if (objAjax.readyState == 4)
		{	document.getElementById("contenidoModal").innerHTML = objAjax.responseText;	}
	}

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
				input_nombres:nombres,
				input_apellidos:apellidos,
				input_rut:rut,
				input_fecha_nac:fecha_nac,
				input_telefono:telefono,
				input_tipo:tipo,
				input_correo:correo,
				input_clave:clave},
				beforeSend: function () {
                        $("#contenidoModal").innerHTML = 'Procesando datos, por favor espere...';
                },
				success: function()
				{
					document.getElementById("input_nombres").value = '';
					document.getElementById("input_apellidos").value = '';
					document.getElementById("input_rut").valuee = '';
					document.getElementById("input_fecha_nac").valuee = '2000-01-01';
					document.getElementById("input_telefono").valuee = '';
					document.getElementById("input_tipo").valuee = '';
					document.getElementById("input_correo").valuee = '';
					document.getElementById("input_clave").valuee = '';
					document.getElementById("input_clave2").valuee = '';
					document.getElementById("ModalPrincipio").innerHTML = "Iniciar Sesión";
					objAjax.open("POST","formularios/inicio_sesion.php"); 	//Abrir conexion
					objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
					objAjax.send(null);
					document.getElementById("contenidoModal").innerHTML = objAjax.responseText;
				}
		})
	}

	function ActualizarUsuario(){
		var nombres 	= document.getElementById("input_nombres").value;
		var apellidos 	= document.getElementById("input_apellidos").value;
		var fecha_nac 	= document.getElementById("input_fecha_nac").value;
		var telefono 	= document.getElementById("input_telefono").value;
		var correo 		= document.getElementById("input_correo").value;
		var clave 		= document.getElementById("input_clave").value;

		var url="datos/actualizar_usuario.php";
		$.ajax({
			type:"POST",
			url:url,
			data:{
				input_nombres:nombres,
				input_apellidos:apellidos,
				input_fecha_nac:fecha_nac,
				input_telefono:telefono,
				input_correo:correo,
				input_clave:clave},
				success: function()
				{
					document.getElementById("input_nombres").value = '';
					document.getElementById("input_apellidos").value = '';
					document.getElementById("input_fecha_nac").valuee = '2000-01-01';
					document.getElementById("input_telefono").valuee = '';
					document.getElementById("input_correo").valuee = '';
					document.getElementById("input_clave").valuee = '';
					document.getElementById("input_clave2").valuee = '';
				}
		})
	}

	function BorrarUsuario(x){
		objAjax.open("POST","datos/borrar_usuario.php"); 	//Abrir conexion
		objAjax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		objAjax.send('cod='+x);
	}

	function verificar_existencia(tipo, dato){
		var respuesta = null;
		var url="datos/verificar_existencia.php";
		$.ajax({
			async: false,
			type:"POST",
			url:url,
			data:{input_tipo:tipo, input_dato:dato},
			success: function(data)
			{
				respuesta = data;
			}
		});
		return respuesta;
	}

	function comprobar_registrar_usuario()
	{
		// NOMBRES
		var verificar_nombres = false;
		var nombres = document.getElementById("input_nombres").value;
		if(nombres.length==0)
		{
			$('#errorNombres').html('<div id="alert-danger-nombres" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica nombres: </strong>No hay datos.</div>');
				$("#alert-danger-nombres").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-nombres").slideUp(500);
				});
		}
		else
		{
			if(nombres.length>2 && nombres.length<30)
			{
				// VERIFICAR SOLO CARACTERES VALIDOS
				patron=/^[a-z A-Z áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ]{2,30}$/;
				if (patron.test($('#input_nombres').val().trim()))
				{
					verificar_nombres = true;
				}
				else
				{	
					$('#errorNombres').html('<div id="alert-danger-nombres" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica nombres: </strong>Carácteres no válidos.</div>');
					$("#alert-danger-nombres").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-nombres").slideUp(500);
					});
				}
			}
			else
			{	$('#errorNombres').html('<div id="alert-danger-nombres" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica nombres: </strong>Cantidad de datos ingresados.</div>');
					$("#alert-danger-nombres").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-nombres").slideUp(500);
					});
			}
		}

		// APELLIDOS
		var verificar_apellidos = false;
		var apellidos = document.getElementById("input_apellidos").value;
		if(apellidos.length==0)
		{
			$('#errorApellidos').html('<div id="alert-danger-apellidos" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica apellidos: </strong>No hay datos.</div>');
				$("#alert-danger-apellidos").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-apellidos").slideUp(500);
				});
		}
		else
		{
			if(apellidos.length>2 && apellidos.length<30)
			{
				// VERIFICAR SOLO CARACTERES VALIDOS
				patron=/^[a-z A-Z áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ]{2,30}$/;
				if (patron.test($('#input_apellidos').val().trim()))
				{
					verificar_apellidos = true;
				}
				else
				{	
					$('#errorApellidos').html('<div id="alert-danger-apellidos" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica apellidos: </strong>Carácteres no válidos.</div>');
					$("#alert-danger-apellidos").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-apellidos").slideUp(500);
					});
				}
			}
			else
			{	$('#errorApellidos').html('<div id="alert-danger-apellidos" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica apellidos: </strong>Cantidad de datos ingresados.</div>');
					$("#alert-danger-apellidos").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-apellidos").slideUp(500);
					});
			}
		}

		// RUT
		var verificar_rut = false;
		var rut = document.getElementById("input_rut").value;
		if(rut.length>8 && rut.length<11)
		{
			patron=/^[0-9-]{2,10}$/;
			if (patron.test($('#input_rut').val().trim()))
			{
				var p = verificar_existencia('rut',rut);
				if(p=='si')
				{	
					$('#errorRut').html('<div id="alert-danger-rut" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica tu RUT: </strong>Ya existe.</div>');
					$("#alert-danger-rut").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-rut").slideUp(500);
					});
				}
				else
				{	verificar_rut = true;	}
			}
			else
			{
				$('#errorRut').html('<div id="alert-danger-rut" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica tu RUT: </strong>Carácteres no válidos.</div>');
					$("#alert-danger-rut").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-rut").slideUp(500);
					});
			}
		}
		else
		{	$('#errorRut').html('<div id="alert-danger-rut" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica tu RUT: </strong>Largo de RUT.</div>');
				$("#alert-danger-rut").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-rut").slideUp(500);
				});
		}

		// TELEFONO
		var verificar_telefono = false;
		var telefono = document.getElementById("input_telefono").value;
		if(telefono.length==0)
		{
			$('#errorTelefono').html('<div id="alert-danger-telefono" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica teléfono: </strong>No hay datos.</div>');
				$("#alert-danger-telefono").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-telefono").slideUp(500);
				});
		}
		else
		{
			if(telefono.length>7 && telefono.length<11)
			{
				// VERIFICAR SOLO CARACTERES VALIDOS
				patron=/^[0-9]{8,11}$/;
				if (patron.test($('#input_telefono').val().trim()))
				{
					verificar_telefono = true;
				}
				else
				{	
					$('#errorTelefono').html('<div id="alert-danger-telefono" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica teléfono: </strong>Carácteres no válidos.</div>');
					$("#alert-danger-telefono").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-telefono").slideUp(500);
					});
				}
			}
			else
			{	$('#errorTelefono').html('<div id="alert-danger-telefono" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica teléfono: </strong>Cantidad de datos ingresados.</div>');
					$("#alert-danger-telefono").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-telefono").slideUp(500);
					});
			}
		}

		// CORREO
		var verificar_correo = false;
		var correo = document.getElementById("input_correo").value;
		if (correo.length==0)
		{
			$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>No hay datos.</div>');
			$("#alert-danger-correo").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-correo").slideUp(500);
				});
		}
		else
		{
			var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
			if (regex.test($('#input_correo').val().trim())) 
			{
				if (correo.length>5 && correo.length<40)
				{
					var p = verificar_existencia('correo',correo);
					if(p=='si')
					{
						$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica tu RUT: </strong>Ya existe.</div>');
						$("#alert-danger-correo").fadeTo(2000, 500).slideUp(500, function(){
    					$("#alert-danger-correo").slideUp(500);
				});
					}
					else
					{
						verificar_correo = true;
					}
				}
				else
				{
					$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>Largo de correo incorrecto</div>');
					$("#alert-danger-correo").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-correo").slideUp(500);
				});
				}
			}
			else
			{
				$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>Carácteres no válidos.</div>');
			}
		}

		// CONTRASEÑA
		var verificar_clave = false;
		var clave = document.getElementById("input_clave").value;
		var clave2 = document.getElementById("input_clave2").value;
		if(clave.length==0 && clave2.length==0)
		{
			$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseñas: </strong>Cantidad de datos.</div>');
				$("#alert-danger-clave").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-clave").slideUp(500);
				});
		}
		else
		{
			if(clave==clave2)
			{
				if(clave.length>4 && clave.length<20)
				{
					// VERIFICAR SOLO CARACTERES VALIDOS
					patron=/^[a-zA-Z0-9._%+-]{4,30}$/;
					if (patron.test($('#input_clave').val().trim()))
					{
						verificar_clave = true;
					}
					else
					{	
						$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseñas: </strong>Carácteres no válidos.</div>');
						$("#alert-danger-clave").fadeTo(2000, 500).slideUp(500, function(){
		    			$("#alert-danger-clave").slideUp(500);
						});
					}
				}
				else
				{	$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseñas: </strong>Cantidad de datos ingresados.</div>');
						$("#alert-danger-clave").fadeTo(2000, 500).slideUp(500, function(){
		    			$("#alert-danger-clave").slideUp(500);
						});
				}
			}
			else
			{
				$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseñas: </strong><div>No coinciden.</div>');
						$("#alert-danger-clave").fadeTo(2000, 500).slideUp(500, function(){
		    			$("#alert-danger-clave").slideUp(500);
						});
			}
		}

		if(verificar_nombres && verificar_apellidos && verificar_rut && verificar_correo && verificar_telefono && verificar_clave)
		{
			RegistrarUsuario();
		}
	}

	function Iniciar_sesion()
	{
		var usuario = document.getElementById("input_usuario").value;
		var u = verificar_existencia('usuario', usuario);
		var clave = document.getElementById("input_clave").value;

		if(usuario.length>0 && clave.length>0)
		{
			if (u=='si')
			{
				var c = verificar_existencia(usuario,clave);
				if(c=='si')
				{
					var url="datos/autenticacion.php";
					$.ajax({
						async: false,
						type:"POST",
						url:url,
						data:{input_usuario:usuario, input_clave:clave},
						success: function()
						{
							window.location.href = "./";
						}
					});
				}
				else
				{
					$('#errorIniciarSesion').html('<div id="alert-danger-iniciar" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica usuario: </strong>Datos no coinciden.</div>');
					$("#alert-danger-iniciar").fadeTo(2000, 500).slideUp(500, function(){
				    $("#alert-danger-iniciar").slideUp(500);
					});
				}
			}
			else
			{
				$('#errorIniciarSesion').html('<div id="alert-danger-iniciar" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica usuario: </strong>No registrado.</div>');
				$("#alert-danger-iniciar").fadeTo(2000, 500).slideUp(500, function(){
			    $("#alert-danger-iniciar").slideUp(500);
				});
			}
		}
		else
		{
			$('#errorIniciarSesion').html('<div id="alert-danger-iniciar" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica usuario: </strong>Complete los campos.</div>');
				$("#alert-danger-iniciar").fadeTo(2000, 500).slideUp(500, function(){
			    $("#alert-danger-iniciar").slideUp(500);
				});
		}
	}

	function comprobar_actualizar_usuario(){
		// NOMBRES
		var verificar_nombres = false;
		var nombres = document.getElementById("input_nombres").value;
		if(nombres.length==0)
		{
			$('#errorNombres').html('<div id="alert-danger-nombres" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica nombres: </strong>No hay datos.</div>');
				$("#alert-danger-nombres").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-nombres").slideUp(500);
				});
		}
		else
		{
			if(nombres.length>2 && nombres.length<30)
			{
				// VERIFICAR SOLO CARACTERES VALIDOS
				patron=/^[a-z A-Z áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ]{2,30}$/;
				if (patron.test($('#input_nombres').val().trim()))
				{
					verificar_nombres = true;
				}
				else
				{	
					$('#errorNombres').html('<div id="alert-danger-nombres" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica nombres: </strong>Carácteres no válidos.</div>');
					$("#alert-danger-nombres").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-nombres").slideUp(500);
					});
				}
			}
			else
			{	$('#errorNombres').html('<div id="alert-danger-nombres" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica nombres: </strong>Cantidad de datos ingresados.</div>');
					$("#alert-danger-nombres").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-nombres").slideUp(500);
					});
			}
		}

		// APELLIDOS
		var verificar_apellidos = false;
		var apellidos = document.getElementById("input_apellidos").value;
		if(apellidos.length==0)
		{
			$('#errorApellidos').html('<div id="alert-danger-apellidos" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica apellidos: </strong>No hay datos.</div>');
				$("#alert-danger-apellidos").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-apellidos").slideUp(500);
				});
		}
		else
		{
			if(apellidos.length>2 && apellidos.length<30)
			{
				// VERIFICAR SOLO CARACTERES VALIDOS
				patron=/^[a-z A-Z áéíóúÁÉÍÓÚäëïöüÄËÏÖÜñÑ]{2,30}$/;
				if (patron.test($('#input_apellidos').val().trim()))
				{
					verificar_apellidos = true;
				}
				else
				{	
					$('#errorApellidos').html('<div id="alert-danger-apellidos" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica apellidos: </strong>Carácteres no válidos.</div>');
					$("#alert-danger-apellidos").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-apellidos").slideUp(500);
					});
				}
			}
			else
			{	$('#errorApellidos').html('<div id="alert-danger-apellidos" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica apellidos: </strong>Cantidad de datos ingresados.</div>');
					$("#alert-danger-apellidos").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-apellidos").slideUp(500);
					});
			}
		}

		// TELEFONO
		var verificar_telefono = false;
		var telefono = document.getElementById("input_telefono").value;
		if(telefono.length==0)
		{
			$('#errorTelefono').html('<div id="alert-danger-telefono" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica teléfono: </strong>No hay datos.</div>');
				$("#alert-danger-telefono").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-telefono").slideUp(500);
				});
		}
		else
		{
			if(telefono.length>7 && telefono.length<11)
			{
				// VERIFICAR SOLO CARACTERES VALIDOS
				patron=/^[0-9]{8,11}$/;
				if (patron.test($('#input_telefono').val().trim()))
				{
					
					verificar_telefono = true;
				}
				else
				{	
					$('#errorTelefono').html('<div id="alert-danger-telefono" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica teléfono: </strong>Carácteres no válidos.</div>');
					$("#alert-danger-telefono").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-telefono").slideUp(500);
					});
				}
			}
			else
			{	$('#errorTelefono').html('<div id="alert-danger-telefono" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica teléfono: </strong>Cantidad de datos ingresados.</div>');
					$("#alert-danger-telefono").fadeTo(2000, 500).slideUp(500, function(){
	    			$("#alert-danger-telefono").slideUp(500);
					});
			}
		}

		// CORREO
		var verificar_correo = false;
		var correo = document.getElementById("input_correo").value;
		if (correo.length==0)
		{
			$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>No hay datos.</div>');
			$("#alert-danger-correo").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-correo").slideUp(500);
				});
		}
		else
		{
			var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
			if (regex.test($('#input_correo').val().trim())) 
			{
				if (correo.length>5 && correo.length<40)
				{
					var p = verificar_existencia('correo_mio',correo);
					if(p=='si')
					{
						$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>Ya existe.</div>');
						$("#alert-danger-correo").fadeTo(2000, 500).slideUp(500, function(){
    					$("#alert-danger-correo").slideUp(500);
						});
					}
					else
					{
						verificar_correo = true;
					}
				}
				else
				{
					$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>Largo de correo incorrecto</div>');
					$("#alert-danger-correo").fadeTo(2000, 500).slideUp(500, function(){
    			$("#alert-danger-correo").slideUp(500);
				});
				}
			}
			else
			{
				$('#errorCorreo').html('<div id="alert-danger-correo" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica correo: </strong>Carácteres no válidos.</div>');
			}
		}

		// CONTRASEÑA
		var verificar_clave = false;
		var clave = document.getElementById("input_clave").value;
		var clave2 = document.getElementById("input_clave2").value;
		if(clave.length==0 && clave2.length==0)
		{
			verificar_clave = true;
		}
		else
		{
			if(clave==clave2)
			{
				if(clave.length>4 && clave.length<20)
				{
					// VERIFICAR SOLO CARACTERES VALIDOS
					patron=/^[a-zA-Z0-9._%+-]{4,30}$/;
					if (patron.test($('#input_clave').val().trim()))
					{
						verificar_clave = true;
					}
					else
					{	
						$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseñas: </strong>Carácteres no válidos.</div>');
						$("#alert-danger-clave").fadeTo(2000, 500).slideUp(500, function(){
		    			$("#alert-danger-clave").slideUp(500);
						});
					}
				}
				else
				{	$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseñas: </strong>Cantidad de datos ingresados.</div>');
						$("#alert-danger-clave").fadeTo(2000, 500).slideUp(500, function(){
		    			$("#alert-danger-clave").slideUp(500);
						});
				}
			}
			else
			{
				$('#errorClave').html('<div id="alert-danger-clave" class="alert alert-danger alert-dismissable"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Verifica contraseñas: </strong><div>No coinciden.</div>');
						$("#alert-danger-clave").fadeTo(2000, 500).slideUp(500, function(){
		    			$("#alert-danger-clave").slideUp(500);
						});
			}
		}

		if(verificar_nombres && verificar_apellidos && verificar_correo && verificar_telefono && verificar_clave)
		{
			alert('Todo correcto!');
			ActualizarUsuario();
			window.location.href = "./";
		}
	}
/*
		var correo = document.getElementById("input_correo").value;
		verificar_existencia('correo',correo);*/

/*
	function FiltroUsuarios() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("FiltroUsuarios");
		filter = input.value.toUpperCase();
		table = document.getElementById("TablaUsuarios");
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
	function VerificarFormularioCrearRifa()
	{
		var cantidad 	= document.getElementById('input_cant').value;
		var valor 		= document.getElementById('input_valor').value;
			var validocantidad 	= false;
			var validovalor 	= false;
		
		if (cantidad.length==0 || cantidad<5 || cantidad>20){
			$("#input_cant").addClass("errorInput");
			}
		else{	
			$("#input_cant").removeClass("errorInput");
											validocantidad = true;}
		if (valor.length==0 || valor<200 || valor>5000){
			$("#input_valor").addClass("errorInput");
			}
		else{	
			$("#input_valor").removeClass("errorInput");
											validovalor = true;}
		if( validocantidad==false || validovalor==false)
		{
			var x = document.getElementById("RespuestaError");
			x.className = "show";
			setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
		}
		else
		{
			var cantidad 	= document.getElementById('input_cant').value;
			var valor 		= document.getElementById('input_valor').value;
			var url="datos/registrar_rifa.php";
			$.ajax({
				type:"POST",
				url:url,
				data:{
					input_cantidad:cantidad,
					input_valor:valor},
						success:function(){
							alert("Rifa Registrada.");						
						}
				})
		}
	}*/