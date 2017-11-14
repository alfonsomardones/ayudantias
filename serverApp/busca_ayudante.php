<?php
if(isset($_POST["tipo"]))
{

	$tipo = $_POST["tipo"];
	$dato = $_POST["dato"];
 $id_usuario = $_POST["id_usuario"];
	$json = "No se han encontrado datos.";
	$cont = 0;
	/*
	$tipo = "carrera";
	$dato = "MEDICINA VETERINARIA-Lunes-9-14";*/
	include('conex.inc');
    if($tipo=="nombres")
    {
		// RECIBE DATO Y SEPARA POR - EJEMPLO: JUANITO PEREZ-TODOS-9:00-22:00
	    $datos 				= explode("-", $dato);
	    $datos_ingresados 	= strtoupper($datos[0]);
	    $datos_ingresados 	= explode(" ", $datos_ingresados);
	    $dia 				= $datos[1];
	    $hora_inicio 		= $datos[2].":00";
	    $hora_final 		= $datos[3].":00";

	    $sql = "INSERT INTO actividades (id_usuario, actividad, filtro, valor, fecha) ";
	    $sql.= "VALUES ($id_usuario,'Búsqueda de ayudante', 'Nombres/Apellidos','".$datos[0]."','".date("Y-m-d H:i:s")."')";
	    $insertar = mysqli_query($db,$sql);

    	// BUSCA TODOS LOS AYUDANTES Y SUS DATOS
    	$sql 		= "SELECT * FROM usuarios WHERE id_tipo_usuario=2";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'AYUDANTES': [";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$id_usuario 			= $lista['id_usuario'];
				$nombres_original 		= $lista['nombres'];
				$apellidos_original 	= $lista['apellidos'];
				$nombres 				= explode(" ", strtoupper($nombres_original));
				$apellidos 				= explode(" ", strtoupper($apellidos_original));

				$bandera = 0;
				for ($i=0; $i < count($nombres); $i++)
				{ 
					for ($j=0; $j < count($datos_ingresados); $j++)
					{ 
						if($nombres[$i]==$datos_ingresados[$j])
						{
							$bandera = 1;
						}
					}
				}
				for ($i=0; $i < count($apellidos); $i++)
				{ 
					for ($j=0; $j < count($datos_ingresados); $j++) 
					{
						if($apellidos[$i]==$datos_ingresados[$j])
						{ 	
							$bandera = 1;
						}
					}
				}
				// SI ALGUN DATO CALZA BUSCA SUS DATOS
				if($bandera>0)
				{
					// SI ALGUN DATO CALZA BUSCA SUS DATOS
					$sql1 		= "SELECT * FROM ayudantes WHERE id_usuario=".$id_usuario;
					$resultado1 	= mysqli_query($db,$sql1);
					$contador1 	= mysqli_num_rows($resultado1);
					if ($contador1>0)
					{
						while ($lista1 = mysqli_fetch_array($resultado1))
						{
							$total = "";
							$id_ayudante 				= $lista1['id_ayudante'];
							$id_institucion_carrera 	= $lista1['id_institucion_carrera'];
							$descripcion 				= $lista1['descripcion'];
							$id_certificacion 			= $lista1['id_certificacion'];
							// busca por dia
							if($dia=="Todos los días")
							{	$sql2 	= "SELECT * FROM horarios WHERE id_ayudante=".$id_ayudante." AND hora_inicio>='$hora_inicio' AND hora_inicio<='$hora_final' OR hora_termino>='hora_inicio' AND hora_termino<='hora_final'";
							}
							else
							{	
								$sql2 	= "SELECT * FROM horarios WHERE id_ayudante=".$id_ayudante." AND dia='$dia' AND hora_inicio>='$hora_inicio' AND hora_inicio<='$hora_final' OR hora_termino>='hora_inicio' AND hora_termino<='hora_final'";
							}
							//echo $hora_inicio;
							$resultado2 	= mysqli_query($db,$sql2);
							$contador2 	= mysqli_num_rows($resultado2);
							if ($contador2>0)
							{	$horario = True;	}
							else
							{	$horario = False;	}
							if($horario)
							{		
								$sql2 		= "SELECT * FROM institucion_carrera WHERE id_institucion_carrera=".$id_institucion_carrera;
								$resultado2 	= mysqli_query($db,$sql2);
								$contador2 	= mysqli_num_rows($resultado2);
								if ($contador2>0)
								{
									$lista2 = mysqli_fetch_array($resultado2);
									$id_institucion 	= $lista2['id_institucion'];
									$id_carrera 		= $lista2['id_carrera'];
				
									$sql3 		= "SELECT * FROM instituciones WHERE id_institucion=".$id_institucion;
									$resultado3 	= mysqli_query($db,$sql3);
									$contador3 	= mysqli_num_rows($resultado3);
									if ($contador3>0)
									{
										$lista3 = mysqli_fetch_array($resultado3);
										$nombre_institucion 	= $lista3['nombre'];
									}
									else
									{		$nombre_institucion = "No hay datos de institución.";				}
									
									$sql3 		= "SELECT * FROM carreras WHERE id_carrera=".$id_carrera;
									$resultado3 	= mysqli_query($db,$sql3);
									$contador3 	= mysqli_num_rows($resultado3);
									if ($contador3>0)
									{
										$lista3 = mysqli_fetch_array($resultado3);
										$nombre_carrera 	= $lista3['nombre'];
									}
									else
									{	$nombre_carrera = "No hay datos de carrera.";	}
								}
								else
								{
									$nombre_institucion = "No hay asociación de institución-carrera.";
									$nombre_carrera = "No hay asociación de institución-carrera.";
								}

								if(strlen($descripcion)==0 || empty($descripcion))
								{	$descripcion = "No hay descripción.";		}
								if(strlen($id_certificacion)>0)
								{
									$sql3 		= "SELECT * FROM certificacion WHERE id_certificacion=".$id_certificacion;
									$resultado3 	= mysqli_query($db,$sql3);
									$contador3 	= mysqli_num_rows($resultado3);
									if ($contador3>0)
									{
										$lista3 = mysqli_fetch_array($resultado3);
										$nombre_certificacion 	= $lista3['nombre'];
									}	
									else
									{	$nombre_certificacion = "No hay datos de la certificación.";	}
								}
								else
								{	$nombre_certificacion = "No hay certificación.";		}

								$sql3 		= "SELECT * FROM ayudante_especialidad WHERE id_ayudante=".$id_ayudante;
								$resultado3 	= mysqli_query($db,$sql3);
								$contador3 	= mysqli_num_rows($resultado3);
								if ($contador3>0)
								{
									$especialidades = "";
									while ($lista3 = mysqli_fetch_array($resultado3))
									{
										$id_especialidad 	= $lista3['id_especialidad'];

										$sql4 		= "SELECT * FROM especialidades WHERE id_especialidad=".$id_especialidad;
										$resultado4 	= mysqli_query($db,$sql4);
										$contador4 	= mysqli_num_rows($resultado4);
										if ($contador4>0)
										{
											$lista4 = mysqli_fetch_array($resultado4);
											$nombre_especialidad 	= $lista4['nombre'];
											$especialidades.= 	"$nombre_especialidad-";							
										}
										else{		$especialidades.= "No hay datos de especialidad.-";}

									}
									$especialidades = substr($especialidades, 0, -1);
								}
								else
								{	$especialidades = "No tiene especialidades.";	}

								$sql5 		= "SELECT AVG(valor) FROM valoracion_ayudantes WHERE id_ayudante=".$id_ayudante;
								$resultado5 	= mysqli_query($db,$sql5);
								$contador5 	= mysqli_num_rows($resultado5);
								if ($contador5>0)
								{
									$lista5 = mysqli_fetch_array($resultado5);
									$valoracion = $lista5[0];
								}
								else
								{
									$valoracion = 0;
								}
								$total.= "{'ID_USUARIO':$id_usuario,'ID_AYUDANTE':$id_ayudante, 'NOMBRES':'$nombres_original $apellidos_original', 'DESCRIPCION':'$descripcion','CERTIFICACION':'$nombre_certificacion','INSTITUCION':'$nombre_institucion','CARRERA':'$nombre_carrera', 'ESPECIALIDADES': '$especialidades','VALORACION':'$valoracion'},";
								$cont = $cont +1; 
							}
							if(strlen($total)>0)
							{
								$json.= $total;
							}
						}
					}
				}
			}
			if(strlen($json)>50)
			{
				$json = substr($json, 0, -1);
				$json.= "]}";

			}
			else
			{
				$json = "No hay ayudantes que cumplan con lo solicitado.";
			}
		}
		else
		{
			$json = "No hay ayudantes.";
		}
    }
    elseif($tipo=="carrera")
    {
    	// RECIBE DATO Y SEPARA POR - EJEMPLO: JUANITO PEREZ-TODOS-9:00-22:00
	    $datos 				= explode("-", $dato);
	    $datos_ingresados 	= strtoupper($datos[0]);
	    $dia 				= $datos[1];
	    $hora_inicio 		= $datos[2].":00";
	    $hora_final 		= $datos[3].":00";
	    
	    $sql = "INSERT INTO actividades (id_usuario, actividad, filtro, valor,fecha) ";
	    $sql.= "VALUES ($id_usuario,'Búsqueda de ayudante','Carrera','".$datos_ingresados."','".date("Y-m-d H:i:s")."')";
	    $insertar = mysqli_query($db,$sql);

    	// BUSCA TODOS LOS AYUDANTES Y SUS DATOS
    	$sql 		= "SELECT * FROM usuarios WHERE id_tipo_usuario=2";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'AYUDANTES': [";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$bandera = 0;
				$id_usuario = $lista['id_usuario'];
				$nombres 	= $lista['nombres'];
				$apellidos 	= $lista['apellidos'];
					// SI ALGUN DATO CALZA BUSCA SUS DATOS
				$sql1 		= "SELECT * FROM ayudantes WHERE id_usuario=".$id_usuario;
				$resultado1 	= mysqli_query($db,$sql1);
				$contador1 	= mysqli_num_rows($resultado1);
				if ($contador1>0)
				{
					while ($lista1 = mysqli_fetch_array($resultado1))
					{
						$total = "";
						$id_ayudante 				= $lista1['id_ayudante'];
						$id_institucion_carrera 	= $lista1['id_institucion_carrera'];
						$descripcion 				= $lista1['descripcion'];
						$id_certificacion 			= $lista1['id_certificacion'];
						// busca por dia
						if($dia=="Todos los días")
						{	$sql2 	= "SELECT * FROM horarios WHERE id_ayudante=".$id_ayudante." AND hora_inicio>='$hora_inicio' AND hora_inicio<='$hora_final' OR hora_termino>='hora_inicio' AND hora_termino<='hora_final'";
						}
						else
						{	
							//$dia = $dia[0] . strtolower(substr($dia, 1));
							
							$sql2 	= "SELECT * FROM horarios WHERE id_ayudante=".$id_ayudante." AND dia='$dia' AND hora_inicio>='$hora_inicio' AND hora_inicio<='$hora_final' OR hora_termino>='hora_inicio' AND hora_termino<='hora_final'";
						}
						$resultado2 	= mysqli_query($db,$sql2);
						$contador2 	= mysqli_num_rows($resultado2);
						if ($contador2>0)
						{	$horario = True;	}
						else
						{	$horario = False;	}
						if($horario)
						{		
							$sql2 		= "SELECT * FROM institucion_carrera WHERE id_institucion_carrera=".$id_institucion_carrera;
							$resultado2 	= mysqli_query($db,$sql2);
							$contador2 	= mysqli_num_rows($resultado2);
							if ($contador2>0)
							{
								$lista2 = mysqli_fetch_array($resultado2);
								$id_institucion 	= $lista2['id_institucion'];
								$id_carrera 		= $lista2['id_carrera'];
				
								$sql3 		= "SELECT * FROM instituciones WHERE id_institucion=".$id_institucion;
								$resultado3 	= mysqli_query($db,$sql3);
								$contador3 	= mysqli_num_rows($resultado3);
								if ($contador3>0)
								{
									$lista3 = mysqli_fetch_array($resultado3);
									$nombre_institucion 	= $lista3['nombre'];
								}
								else
								{		$nombre_institucion = "No hay datos de institución.";				}
									
								$sql3 		= "SELECT * FROM carreras WHERE id_carrera=".$id_carrera;
								$resultado3 	= mysqli_query($db,$sql3);
								$contador3 	= mysqli_num_rows($resultado3);
								if ($contador3>0)
								{
									$lista3 = mysqli_fetch_array($resultado3);
									$nombre_carrera 	= $lista3['nombre'];
								}
								else
								{	$nombre_carrera = "No hay datos de carrera.";	}
								if($nombre_carrera==$datos_ingresados)
								{
									$bandera = 1;
								}
							}
							else
							{
								$nombre_institucion = "No hay asociación de institución-carrera.";
								$nombre_carrera = "No hay asociación de institución-carrera.";
							}
							if(strlen($descripcion)==0 || empty($descripcion))
							{	$descripcion = "No hay descripción.";		}
							if(strlen($id_certificacion)>0)
							{
								$sql3 		= "SELECT * FROM certificacion WHERE id_certificacion=".$id_certificacion;
								$resultado3 	= mysqli_query($db,$sql3);
								$contador3 	= mysqli_num_rows($resultado3);
								if ($contador3>0)
								{
									$lista3 = mysqli_fetch_array($resultado3);
									$nombre_certificacion 	= $lista3['nombre'];
								}	
								else
								{	$nombre_certificacion = "No hay datos de la certificación.";	}
							}
							else
							{	$nombre_certificacion = "No hay certificación.";		}
							$sql3 		= "SELECT * FROM ayudante_especialidad WHERE id_ayudante=".$id_ayudante;
							$resultado3 	= mysqli_query($db,$sql3);
							$contador3 	= mysqli_num_rows($resultado3);
							if ($contador3>0)
							{
								$especialidades = "";
								while ($lista3 = mysqli_fetch_array($resultado3))
								{
									$id_especialidad 	= $lista3['id_especialidad'];

									$sql4 		= "SELECT * FROM especialidades WHERE id_especialidad=".$id_especialidad;
									$resultado4 	= mysqli_query($db,$sql4);
									$contador4 	= mysqli_num_rows($resultado4);
									if ($contador4>0)
									{
										$lista4 = mysqli_fetch_array($resultado4);
										$nombre_especialidad 	= $lista4['nombre'];
										$especialidades.= 	"$nombre_especialidad-";							
									}
									else{		$especialidades.= "No hay datos de especialidad.-";}
								}
								$especialidades = substr($especialidades, 0, -1);
							}
							else
							{	$especialidades = "No tiene especialidades.";	}

							$sql5 		= "SELECT AVG(valor) FROM valoracion_ayudantes WHERE id_ayudante=".$id_ayudante;
							$resultado5 	= mysqli_query($db,$sql5);
							$contador5 	= mysqli_num_rows($resultado5);
							if ($contador5>0)
							{
								$lista5 = mysqli_fetch_array($resultado5);
								$valoracion = $lista5[0];
							}
							else
							{	$valoracion = 0;	}

							if($bandera>0)
							{
								$total.= "{'ID_USUARIO':$id_usuario,'ID_AYUDANTE':$id_ayudante,'NOMBRES':'$nombres $apellidos', 'DESCRIPCION':'$descripcion','CERTIFICACION':'$nombre_certificacion','INSTITUCION':'$nombre_institucion','CARRERA':'$nombre_carrera', 'ESPECIALIDADES': '$especialidades','VALORACION':'$valoracion'},";
								$cont = $cont +1; 
							}
						}
						if(strlen($total)>0)
						{
							$json.= $total;
						}
					}
				}
			}
			if(strlen($json)>50)
			{
				$json = substr($json, 0, -1);
				$json.= "]}";

			}
			else
			{
				$json = "No hay ayudantes que cumplan con lo solicitado.";
			}
		}
		else
		{
			$json = "No hay ayudantes.";
		}
	}    
	elseif ($tipo=="especialidad") {
		    	// RECIBE DATO Y SEPARA POR - EJEMPLO: JUANITO PEREZ-TODOS-9:00-22:00
	    $datos 				= explode("-", $dato);
	    $datos_ingresados 	= $datos[0];
	    $dia 				= $datos[1];
	    $hora_inicio 		= $datos[2].":00";
	    $hora_final 		= $datos[3].":00";
		
		$sql = "INSERT INTO actividades (id_usuario, actividad, filtro, valor,fecha) ";
	    $sql.= "VALUES ($id_usuario,'Búsqueda de ayudante', 'Especialidad','".$datos_ingresados."','".date("Y-m-d H:i:s")."')";
	    $insertar = mysqli_query($db,$sql);

    	// BUSCA TODOS LOS AYUDANTES Y SUS DATOS
    	$sql 		= "SELECT * FROM usuarios WHERE id_tipo_usuario=2";
		$resultado 	= mysqli_query($db,$sql);
		$contador 	= mysqli_num_rows($resultado);
		if ($contador>0)
		{
			$json = "{ 'AYUDANTES': [";
			while ($lista = mysqli_fetch_array($resultado))
			{
				$bandera = 0;
				$id_usuario = $lista['id_usuario'];
				$nombres 	= $lista['nombres'];
				$apellidos 	= $lista['apellidos'];
					// SI ALGUN DATO CALZA BUSCA SUS DATOS
				$sql1 		= "SELECT * FROM ayudantes WHERE id_usuario=".$id_usuario;
				$resultado1 	= mysqli_query($db,$sql1);
				$contador1 	= mysqli_num_rows($resultado1);
				if ($contador1>0)
				{
					while ($lista1 = mysqli_fetch_array($resultado1))
					{
						$total = "";
						$id_ayudante 				= $lista1['id_ayudante'];
						$id_institucion_carrera 	= $lista1['id_institucion_carrera'];
						$descripcion 				= $lista1['descripcion'];
						$id_certificacion 			= $lista1['id_certificacion'];
						// busca por dia
						if($dia=="Todos los días")
							{	$sql2 	= "SELECT * FROM horarios WHERE id_ayudante=".$id_ayudante." AND hora_inicio>='$hora_inicio' AND hora_inicio<='$hora_final' OR hora_termino>='hora_inicio' AND hora_termino<='hora_final'";
							}
							else
							{	
								$sql2 	= "SELECT * FROM horarios WHERE id_ayudante=".$id_ayudante." AND dia='$dia' AND hora_inicio>='$hora_inicio' AND hora_inicio<='$hora_final' OR hora_termino>='hora_inicio' AND hora_termino<='hora_final'";
							}
						$resultado2 	= mysqli_query($db,$sql2);
						$contador2 	= mysqli_num_rows($resultado2);
						if ($contador2>0)
						{	$horario = True;	}
						else
						{	$horario = False;	}
						if($horario)
						{		
							$sql2 		= "SELECT * FROM institucion_carrera WHERE id_institucion_carrera=".$id_institucion_carrera;
							$resultado2 	= mysqli_query($db,$sql2);
							$contador2 	= mysqli_num_rows($resultado2);
							if ($contador2>0)
							{
								$lista2 = mysqli_fetch_array($resultado2);
								$id_institucion 	= $lista2['id_institucion'];
								$id_carrera 		= $lista2['id_carrera'];
				
								$sql3 		= "SELECT * FROM instituciones WHERE id_institucion=".$id_institucion;
								$resultado3 	= mysqli_query($db,$sql3);
								$contador3 	= mysqli_num_rows($resultado3);
								if ($contador3>0)
								{
									$lista3 = mysqli_fetch_array($resultado3);
									$nombre_institucion 	= $lista3['nombre'];
								}
								else
								{		$nombre_institucion = "No hay datos de institución.";				}
									
								$sql3 		= "SELECT * FROM carreras WHERE id_carrera=".$id_carrera;
								$resultado3 	= mysqli_query($db,$sql3);
								$contador3 	= mysqli_num_rows($resultado3);
								if ($contador3>0)
								{
									$lista3 = mysqli_fetch_array($resultado3);
									$nombre_carrera 	= $lista3['nombre'];
								}
								else
								{	$nombre_carrera = "No hay datos de carrera.";	}
							}
							else
							{
								$nombre_institucion = "No hay asociación de institución-carrera.";
								$nombre_carrera = "No hay asociación de institución-carrera.";
							}
							if(strlen($descripcion)==0 || empty($descripcion))
							{	$descripcion = "No hay descripción.";		}
							if(strlen($id_certificacion)>0)
							{
								$sql3 		= "SELECT * FROM certificacion WHERE id_certificacion=".$id_certificacion;
								$resultado3 	= mysqli_query($db,$sql3);
								$contador3 	= mysqli_num_rows($resultado3);
								if ($contador3>0)
								{
									$lista3 = mysqli_fetch_array($resultado3);
									$nombre_certificacion 	= $lista3['nombre'];
								}	
								else
								{	$nombre_certificacion = "No hay datos de la certificación.";	}
							}
							else
							{	$nombre_certificacion = "No hay certificación.";		}
							$sql3 		= "SELECT * FROM ayudante_especialidad WHERE id_ayudante=".$id_ayudante;
							$resultado3 	= mysqli_query($db,$sql3);
							$contador3 	= mysqli_num_rows($resultado3);
							if ($contador3>0)
							{
								$especialidades = "";
								while ($lista3 = mysqli_fetch_array($resultado3))
								{
									$id_especialidad 	= $lista3['id_especialidad'];

									$sql4 		= "SELECT * FROM especialidades WHERE id_especialidad=".$id_especialidad;
									$resultado4 	= mysqli_query($db,$sql4);
									$contador4 	= mysqli_num_rows($resultado4);
									if ($contador4>0)
									{
										$lista4 = mysqli_fetch_array($resultado4);
										$nombre_especialidad 	= $lista4['nombre'];
										if($nombre_especialidad==$datos_ingresados){ $bandera = 1;}
										$especialidades.= 	"$nombre_especialidad-";							
									}
									else{		$especialidades.= "No hay datos de especialidad.-";}
								}
								$especialidades = substr($especialidades, 0, -1);
							}
							else
							{	$especialidades = "No tiene especialidades.";	}

							$sql5 		= "SELECT AVG(valor) FROM valoracion_ayudantes WHERE id_ayudante=".$id_ayudante;
							$resultado5 	= mysqli_query($db,$sql5);
							$contador5 	= mysqli_num_rows($resultado5);
							if ($contador5>0)
							{
								$lista5 = mysqli_fetch_array($resultado5);
								$valoracion = $lista5[0];
							}
							else
							{	$valoracion = 0;	}

							if($bandera>0)
							{
								$total.= "{'ID_USUARIO':$id_usuario,'ID_AYUDANTE':$id_ayudante, 'NOMBRES':'$nombres $apellidos', 'DESCRIPCION':'$descripcion','CERTIFICACION':'$nombre_certificacion','INSTITUCION':'$nombre_institucion','CARRERA':'$nombre_carrera', 'ESPECIALIDADES': '$especialidades','VALORACION':'$valoracion'},";
								$cont = $cont +1; 
							}
						}
						if(strlen($total)>0)
						{
							$json.= $total;
						}
					}
				}
			}
			if(strlen($json)>50)
			{
				$json = substr($json, 0, -1);
				$json.= "]}";

			}
			else
			{
				$json = "No hay ayudantes que cumplan con lo solicitado.";
			}
		}
		else
		{
			$json = "No hay ayudantes.";
		}
	}
    echo $json;
}
else
{	echo "Lo siento, no tienes acceso aquí, debes definir las variables";	}
?>