<?php

include('conex.inc');
    
    $nombres  		= $_POST['nombres'];
    $apellidos     	= $_POST['apellidos'];
    $rut     		= $_POST['rut'];
    $fecha_nac     	= $_POST['fecha_nac'];
    list($dia,$mes,$año) = explode("-", $fecha_nac);
    $fecha_nac = "$año-$mes-$dia";
    $telefono     	= $_POST['telefono'];
    $correo       	= $_POST['correo'];
    $correo         = strtolower($correo);
    $clave       	= $_POST['clave'];
    $clave2 	    = md5($_POST['clave2']); 
    $tipo       	= $_POST['tipo'];
    $imagen			= $_POST['imagen'];
    $estado			= "Habilitado";
    $descripcion 	= $_POST["descripcion"];
    $id_usuario  	= $_POST["id_user"];

    $sql0 = "SELECT clave FROM usuarios WHERE id_usuario=$id_usuario";
    $resultado      = mysqli_query($db,$sql0);
    $lista = mysqli_fetch_array($resultado);
    $clavebd = $lista['clave'];
    $flag = "no";
    if($clave == $clavebd){
        $clave = $clave2;
        $flag = "si";
    }

    $sql = "UPDATE usuarios SET nombres='$nombres', apellidos='$apellidos', rut='$rut', clave='$clave', fecha_nacimiento='$fecha_nac', telefono='$telefono', correo='$correo', id_tipo_usuario=$tipo, imagen='$imagen', estado='$estado' WHERE id_usuario=$id_usuario";

    $actualizar = mysqli_query($db,$sql);

    $actualizar2 = True;
    if($tipo == "2" || $tipo == 2){
    	$sql2 = "UPDATE ayudantes SET descripcion='$descripcion' WHERE id_usuario=$id_usuario";
    	$actualizar2 = mysqli_query($db,$sql2);
    }

    if($actualizar && $actualizar2){
    	echo "Actualizado/$id_usuario/$flag";
    }
    else{
    	echo "Error!/$rut";
    }







?>