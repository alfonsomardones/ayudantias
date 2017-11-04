<?php
if(isset($_POST['input_id']))
{
	include('conex.php');
    $id_ayudante 	= $_POST['input_id'];
    $sql = "DELETE FROM ayudantes WHERE id_ayudante=".$id_ayudante;

    $eliminar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>
