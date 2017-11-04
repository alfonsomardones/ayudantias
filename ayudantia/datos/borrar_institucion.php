<?php
if(isset($_POST['cod']))
{
	include('conex.php');
    $id_institucion 	= $_POST['cod'];
    $sql = "DELETE FROM instituciones WHERE id_institucion=".$id_institucion;

    $eliminar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>
