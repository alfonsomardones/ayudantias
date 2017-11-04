<?php
if(isset($_POST['input_id']))
{
    include('conex.php');
   	$id_ayudante     = $_POST['input_id'];
    
   		$sql1           = "SELECT * FROM instituciones WHERE nombre='Independiente'";
        $resultado1     = mysqli_query($db,$sql1);
        $contador1      = mysqli_num_rows($resultado1);
        if($contador1>0)
        {
            while ($lista1 = mysqli_fetch_array($resultado1))
               {  $id_institucion     = $lista1['id_institucion'];    }
        }

        // BUSCAR CARRERA INDEPENDIENTE, SI NO EXISTE CREAR
        $sql2           = "SELECT * FROM carreras WHERE nombre='Independiente'";
        $resultado2         = mysqli_query($db,$sql2);
        $contador2      = mysqli_num_rows($resultado2);
        if($contador2>0)
        {
            while ($lista2 = mysqli_fetch_array($resultado2))
            {   $id_carrera     = $lista2['id_carrera'];    }
        }

        // BUSCAR INSTITUCION-CARRERA INDEPENDIENTE, SI NO EXISTE CREAR
        $sql3   = "SELECT * FROM institucion_carrera WHERE id_institucion=$id_institucion AND id_carrera=$id_carrera";
        $resultado3         = mysqli_query($db,$sql3);
        $contador3      = mysqli_num_rows($resultado3);
        if($contador3>0)
        {
            while ($lista3 = mysqli_fetch_array($resultado3))
            {   $id_institucion_carrera     = $lista3['id_institucion_carrera'];   }
        }    
    $sql = "UPDATE ayudantes SET id_institucion_carrera='$id_institucion_carrera', id_certificacion=0";
    $sql.= " WHERE id_ayudante=".$id_ayudante;

    $actualizar = mysqli_query($db,$sql);
}
else
{
	header("location: error.php");
}
?>