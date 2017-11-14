<?php
if(isset($_POST['mensaje']))
{
	include('conex.inc');
    
    $fecha  	= date("Y-m-d H:i:s");
	$id_envia = $_SESSION['id_usuario'];
	$id_recibe  = $_POST['input_recibe'];
	$tipo  		= $_POST['input_tipo'];
	$mensaje  	= $_POST['input_mensaje'];

    $sql = "INSERT INTO mensajes (fecha_hora, id_usuario_envia, id_usuario_recibe, tipo_mensaje, mensaje, estado,notificacion) ";
    $sql.= "VALUES ('$fecha',$id_envia, $id_recibe,'$tipo','$mensaje','Pendiente','no')";

    $insertar = mysqli_query($db,$sql);
}
?>