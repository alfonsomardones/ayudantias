<?php
	include('conex.php');
    $id_usuario  				   = $_POST['input_id'];
    $id_institucion_carrera        = $_POST['input_institucion_carrera'];
    $id_certificacion              = $_POST['input_certificacion'];
    if($id_institucion_carrera==0 || $id_institucion_carrera=='0')
    {
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
    }

    $sql = "INSERT INTO ayudantes (id_usuario, id_institucion_carrera, descripcion, id_certificacion) ";
    $sql.= "VALUES ($id_usuario, $id_institucion_carrera,'',$id_certificacion)";
    $insertar = mysqli_query($db,$sql);
?>