<?php
    include('conex.inc');
    
    $nombres  		= $_POST['nombres'];
    $apellidos     	= $_POST['apellidos'];
    $rut     		= $_POST['rut'];
    $fecha_nac     	= $_POST['fecha_nac'];
    list($dia,$mes,$año)     = explode("-", $fecha_nac);
    $fecha_nac = "$año-$mes-$dia";
    $telefono     	= $_POST['telefono'];
    $correo       	= $_POST['correo'];
    $correo         = strtolower($correo);
    $clave       	= $_POST['clave'];
    $clave 			= md5($clave); 
    $tipo       	= $_POST['tipo'];
    $imagen			= $_POST['imagen'];
    $estado			= "Habilitado";
    $descripcion 	= $_POST["descripcion"];
    $especialidades = $_POST["especialidades"];
    $especialidades = explode("-", $especialidades);

    $sql = "SELECT * FROM usuarios WHERE rut='$rut' OR correo='$correo'";
    $resultado  = mysqli_query($db,$sql);
    $contador   = mysqli_num_rows($resultado);
    if ($contador>0) {
        echo "Esta cuenta ya esta en uso!.";
    }
    else{
        $sql = "INSERT INTO usuarios (nombres, apellidos, rut, fecha_nacimiento, telefono, correo, clave, id_tipo_usuario, imagen, estado, año_registro, mes_registro, dia_registro) ";
        $sql.= "VALUES ('$nombres','$apellidos','$rut','$fecha_nac','$telefono','$correo','$clave',$tipo,'$imagen','$estado',".date("Y").",".date("m").",".date("d").")";

        $flag1 = TRUE;
        $flag2 = TRUE;

        if (!$insertar = mysqli_query($db,$sql)){
            $flag1 = FALSE;
        }
        
        if($tipo=='2' || $tipo==2)
        {
            // BUSCAR INSTITUCION INDEPENDIENTE, SI NO EXISTE CREAR
            $sql1           = "SELECT * FROM instituciones WHERE nombre='Independiente'";
            $resultado1     = mysqli_query($db,$sql1);
            $contador1      = mysqli_num_rows($resultado1);
            if($contador1>0)
            {
                while ($lista1 = mysqli_fetch_array($resultado1))
                {
                    $id_institucion     = $lista1['id_institucion'];
                }
            }

            // BUSCAR CARRERA INDEPENDIENTE, SI NO EXISTE CREAR
            $sql2           = "SELECT * FROM carreras WHERE nombre='Independiente'";
            $resultado2         = mysqli_query($db,$sql2);
            $contador2      = mysqli_num_rows($resultado2);
            if($contador2>0)
            {
                while ($lista2 = mysqli_fetch_array($resultado2))
                {
                    $id_carrera     = $lista2['id_carrera'];
                }
            }

            // BUSCAR INSTITUCION-CARRERA INDEPENDIENTE, SI NO EXISTE CREAR
            $sql3           = "SELECT * FROM institucion_carrera WHERE id_institucion=$id_institucion AND id_carrera=$id_carrera";
            $resultado3         = mysqli_query($db,$sql3);
            $contador3      = mysqli_num_rows($resultado3);
            if($contador3>0)
            {
                while ($lista3 = mysqli_fetch_array($resultado3))
                {
                    $id_institucion_carrera     = $lista3['id_institucion_carrera'];
                }
            }
            // AGREGAR AYUDANTE A INDEPENDIENTE
            $sql4           = "SELECT * FROM usuarios WHERE rut='$rut' AND correo='$correo'";
            $resultado4     = mysqli_query($db,$sql4);
            $contador4      = mysqli_num_rows($resultado4);
            if($contador4>0)
            {
                while ($lista4 = mysqli_fetch_array($resultado4))
                {
                    $id_usuario     = $lista4['id_usuario'];
                }
            }

            $sql5 = "INSERT INTO ayudantes (id_usuario, id_institucion_carrera, descripcion, id_certificacion) ";
            $sql5.= "VALUES ($id_usuario, $id_institucion_carrera, '$descripcion',0)";

            if (!($insertar5 = mysqli_query($db,$sql5))){
                $flag2 = FALSE;
            }

            $sql6 = "SELECT * FROM ayudantes WHERE id_usuario=$id_usuario";
            $resultado6     = mysqli_query($db,$sql6);
            $contador6      = mysqli_num_rows($resultado6);
            if($contador6>0)
            {
                $lista6 = mysqli_fetch_array($resultado6);
                $id_ayudante    = $lista6['id_ayudante'];

                for ($i=0; $i <count($especialidades) ; $i++) 
                { 
                	$especialidad = $especialidades[$i];
	            	$sql = "SELECT * FROM especialidades WHERE nombre='$especialidad'";
	                $resultado  = mysqli_query($db,$sql);
	                $contador      = mysqli_num_rows($resultado);
	            	if($contador>0)
	            	{
	                	$lista = mysqli_fetch_array($resultado);
	                	$id_especialidad = $lista["id_especialidad"];

	                	$sql7 = "INSERT INTO ayudante_especialidad (id_ayudante, id_especialidad) ";
	                	$sql7.= "VALUES ($id_ayudante, $id_especialidad)";
	                	$insertar7 = mysqli_query($db,$sql7);
	                }
	                else
	                {
	                	echo "No hay especialidad de nombre: $especialidad.";
	                }
	            }
            }
            else
            {
            	echo "Este usuario es ayudante, pero no hay datos de él en la tabla ayudante.";
            }
        }
        
        if($flag1 && $flag2){
            $sql = "SELECT id_usuario FROM usuarios WHERE rut='$rut' OR correo='$correo'";
            $resultado  = mysqli_query($db,$sql);
            $lista = mysqli_fetch_array($resultado);
            $id_usuario = $lista["id_usuario"];
            echo "Registrado/$id_usuario/$estado";
        }
        else{
            echo "Error!/$flag1/$flag2";
        }
    }    
?>