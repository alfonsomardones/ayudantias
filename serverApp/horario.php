<?php
if(isset($_POST["tipo"]))
{
	include('conex.inc');
    $tipo 		=	$_POST["tipo"];
    $json = "Ayudante sin horario disponible.";

    if($tipo == "1" || $tipo==1){
    	$id_usuario = $_POST["id_usuario"];
    	$sql = "SELECT * FROM ayudantes WHERE id_usuario=$id_usuario";
	    $resultado  = mysqli_query($db,$sql);
	    $lista = mysqli_fetch_array($resultado);
        $id_ayudante = $lista["id_ayudante"];

        $sql1 = "SELECT * FROM horarios WHERE id_ayudante=$id_ayudante";
	    $resultado1  = mysqli_query($db,$sql1);
	    $contador1   = mysqli_num_rows($resultado1);
	    if ($contador1>0) {
			$json = "{ 'HORARIOS': [";
			$total = "";
			// ORDENAR POR DIA
			$sql = "SELECT * FROM horarios WHERE id_ayudante=$id_ayudante AND dia='Lunes' ORDER BY hora_inicio ASC";
		    $resultado  = mysqli_query($db,$sql);
		    $contador   = mysqli_num_rows($resultado);
		    if ($contador>0) {
		    	while ($lista = mysqli_fetch_array($resultado))
		    	{
          			$id_horario = $lista['id_horario'];
		    		$dia 		= $lista['dia'];
		    		$inicio 	= $lista['hora_inicio'];
		    		$inicio 		= substr($inicio, 0,-3);
		    		$termino 	= $lista['hora_termino'];
		    		$termino 		= substr($termino, 0,-3);
		    		$total.= "{'ID_HORARIO':$id_horario,'DIA':'$dia', 'HORA_INICIO':'$inicio:00', 'HORA_TERMINO':'$termino:00'},";
		    	}
		    }
		    $sql = "SELECT * FROM horarios WHERE id_ayudante=$id_ayudante AND dia='Martes' ORDER BY hora_inicio ASC";
		    $resultado  = mysqli_query($db,$sql);
		    $contador   = mysqli_num_rows($resultado);
		    if ($contador>0) {
		    	while ($lista = mysqli_fetch_array($resultado))
		    	{
		    $id_horario = $lista['id_horario'];
		    			$dia 		= $lista['dia'];
		    		$inicio 	= $lista['hora_inicio'];
		    		$inicio 		= substr($inicio, 0,-3);
		    		$termino 	= $lista['hora_termino'];
		    		$termino 		= substr($termino, 0,-3);
		    		$total.= "{'ID_HORARIO':$id_horario,'DIA':'$dia', 'HORA_INICIO':'$inicio', 'HORA_TERMINO':'$termino'},";
		    	}
		    }
		    $sql = "SELECT * FROM horarios WHERE id_ayudante=$id_ayudante AND dia='Miércoles' ORDER BY hora_inicio ASC";
		    $resultado  = mysqli_query($db,$sql);
		    $contador   = mysqli_num_rows($resultado);
		    if ($contador>0) {
		    	while ($lista = mysqli_fetch_array($resultado))
		    	{
		    	$id_horario = $lista['id_horario'];
		    		$dia 		= $lista['dia'];
		    		$inicio 	= $lista['hora_inicio'];
		    		$inicio 		= substr($inicio, 0,-3);
		    		$termino 	= $lista['hora_termino'];
		    		$termino 		= substr($termino, 0,-3);
		    		$total.= "{'ID_HORARIO':$id_horario,'DIA':'$dia', 'HORA_INICIO':'$inicio', 'HORA_TERMINO':'$termino'},";
		    	}
		    }
		    $sql = "SELECT * FROM horarios WHERE id_ayudante=$id_ayudante AND dia='Jueves' ORDER BY hora_inicio ASC";
		    $resultado  = mysqli_query($db,$sql);
		    $contador   = mysqli_num_rows($resultado);
		    if ($contador>0) {
		    	while ($lista = mysqli_fetch_array($resultado))
		    	{
		   $id_horario = $lista['id_horario'];
		    				$dia 		= $lista['dia'];
		    		$inicio 	= $lista['hora_inicio'];
		    		$inicio 		= substr($inicio, 0,-3);
		    		$termino 	= $lista['hora_termino'];
		    		$termino 		= substr($termino, 0,-3);
		    		$total.= "{'ID_HORARIO':$id_horario,'DIA':'$dia', 'HORA_INICIO':'$inicio', 'HORA_TERMINO':'$termino'},";
		    	}
		    }
		    $sql = "SELECT * FROM horarios WHERE id_ayudante=$id_ayudante AND dia='Viernes' ORDER BY hora_inicio ASC";
		    $resultado  = mysqli_query($db,$sql);
		    $contador   = mysqli_num_rows($resultado);
		    if ($contador>0) {
		    	while ($lista = mysqli_fetch_array($resultado))
		    	{
		   $id_horario = $lista['id_horario'];
		    				$dia 		= $lista['dia'];
		    		$inicio 	= $lista['hora_inicio'];
		    		$inicio 		= substr($inicio, 0,-3);
		    		$termino 	= $lista['hora_termino'];
		    		$termino 		= substr($termino, 0,-3);
		    		$total.= "{'ID_HORARIO':$id_horario,'DIA':'$dia', 'HORA_INICIO':'$inicio', 'HORA_TERMINO':'$termino'},";
		    	}
		    }
		    $sql = "SELECT * FROM horarios WHERE id_ayudante=$id_ayudante AND dia='Sábado' ORDER BY hora_inicio ASC";
		    $resultado  = mysqli_query($db,$sql);
		    $contador   = mysqli_num_rows($resultado);
		    if ($contador>0) {
		    	while ($lista = mysqli_fetch_array($resultado))
		    	{
		   $id_horario = $lista['id_horario'];
		    				$dia 		= $lista['dia'];
		    		$inicio 	= $lista['hora_inicio'];
		    		$inicio 		= substr($inicio, 0,-3);
		    		$termino 	= $lista['hora_termino'];
		    		$termino 		= substr($termino, 0,-3);
		    		$total.= "{'ID_HORARIO':$id_horario,'DIA':'$dia', 'HORA_INICIO':'$inicio', 'HORA_TERMINO':'$termino'},";
		    	}
		    }
		    $sql = "SELECT * FROM horarios WHERE id_ayudante=$id_ayudante AND dia='Domingo' ORDER BY hora_inicio ASC";
		    $resultado  = mysqli_query($db,$sql);
		    $contador   = mysqli_num_rows($resultado);
		    if ($contador>0) {
		    	while ($lista = mysqli_fetch_array($resultado))
		    	{
		   $id_horario = $lista['id_horario'];
		    				$dia 		= $lista['dia'];
		    		$inicio 	= $lista['hora_inicio'];
		    		$inicio 		= substr($inicio, 0,-3);
		    		$termino 	= $lista['hora_termino'];
		    		$termino 		= substr($termino, 0,-3);
		    		$total.= "{'ID_HORARIO':$id_horario,'DIA':'$dia', 'HORA_INICIO':'$inicio', 'HORA_TERMINO':'$termino'},";
		    	}
		    }
		    if(strlen($total)>0)
		    {
		    	$total = substr($total, 0, -1);
		    	$json.= $total;
		    }
			$json.= "]}";
	    }
    }
    if($tipo == "2" || $tipo==2)
    {
    	$id_usuario = $_POST["id_usuario"];
    	$dia  		= $_POST['dia'];
    	$inicio  	= $_POST['hora_inicio'];
    	$termino  	= $_POST['hora_termino'];

    	$sql = "SELECT * FROM ayudantes WHERE id_usuario=$id_usuario";
	    $resultado  = mysqli_query($db,$sql);
	    $lista = mysqli_fetch_array($resultado);
      	$id_ayudante = $lista["id_ayudante"];

    	$sql = "INSERT INTO horarios (id_ayudante,dia, hora_inicio, hora_termino) ";
    	$sql.= "VALUES ($id_ayudante,'$dia','$inicio','$termino')";
    	$insertar = mysqli_query($db,$sql);

    	$sql = "INSERT INTO actividades (id_usuario, actividad, filtro, valor,fecha) ";
	    $sql.= "VALUES ($id_usuario,'Registrar horario', '', '$dia - $inicio - $termino','".date("Y-m-d H:i:s")."')";
	    $insertar = mysqli_query($db,$sql);

     	$json = "Horario registrado";
     }


    if($tipo == "3" || $tipo==3)
    {
		$id_horario 		= $_POST['id_horario'];
		$sql = "DELETE FROM horarios WHERE id_horario=$id_horario";

	    $eliminar = mysqli_query($db,$sql);
	    $json = "Registro eliminado";
    }

    if($tipo == "4" || $tipo==4)
    {
		$id_horario 	= $_POST['id_horario'];
		$dia  			= $_POST['dia'];
    	$inicio  		= $_POST['hora_inicio'];
    	$termino  		= $_POST['hora_termino'];
		$sql = "UPDATE horarios SET dia='$dia', hora_inicio='$inicio', hora_termino='$termino' WHERE id_horario=$id_horario";

	    $actualizar = mysqli_query($db,$sql);
	    $json = "Registro actualizado";
    }
    echo $json;
}
?>