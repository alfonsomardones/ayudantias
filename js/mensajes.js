$(document).ready(function() {
});

function mostrarMensaje(datos) {
    id = datos[0]; mensaje = datos[1]; tipo = 'danger';
    if(id>0)
    {tipo = 'success';}
    else
    {
        if(id>-50)
        {tipo = 'warning';}
        else
        {tipo = 'danger';}
    }
    return '<div class="alert alert-'+tipo+' alert-dismissible fade show" role="alert">'+mensaje+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
}

function listadoMensajes(i){
    descripcion = 'SIN ERROR ESTABLECIDO';
    if(i==1)
    {descripcion = 'INICIANDO SESIÓN';}
    else if(i==2)
    {descripcion = 'REGISTRADO CORRECTAMENTE';}
    else if(i==3)
    {descripcion = 'ACTUALIZADO CORRECTAMENTE';}
    else if(i==4)
    {descripcion = 'BORRADO CORRECTAMENTE';}
    else if(i==5)
    {descripcion = 'CUENTA ACTIVADA CORRECTAMENTE';}
    // ALERTA
    else if(i==-1)
    {descripcion = 'USUARIO O CONTRASEÑA INCORRECTOS';}
    else if(i==-2)
    {descripcion = 'COMPLETE TODOS LOS CAMPOS';}
    else if(i==-3)
    {descripcion = 'USUARIO NO REGISTRADO';}
    else if(i==-4)
    {descripcion = 'CONTRASEÑA INCORRECTA';}
    else if(i==-5)
    {descripcion = 'EL RUT YA SE ENCUENTRA REGISTRADO';}
    else if(i==-6)
    {descripcion = 'EL CORREO YA SE ENCUENTRA REGISTRADO';}

    // ERRORES
    else if(i==-50)
    {descripcion = 'USUARIO DESHABILITADO';}
    else if(i==-51)
    {descripcion = 'NO HAS INICIADO SESIÓN';}
    else if(i==-52)
    {descripcion = 'NO TIENES PERMISOS PARA REALIZAR ESTA ACCIÓN';}
    else if(i==-53)
    {descripcion = 'NO RECIBE TODOS LOS DATOS';}
    else if(i==-54)
    {descripcion = 'TU USUARIO NO ES ADMINISTRADOR, DEBES INICIAR SESIÓN DESDE LA APLICACIÓN';}
    else if(i==-55)
    {descripcion = 'SERVIDOR NO RECIBE ID';}
    else if(i==-56)
    {descripcion = 'HAY DATOS INGRESADOS QUE NO SON VÁLIDOS';}
    else if(i==-57)
    {descripcion = 'ESTE USUARIO YA ESTÁ REGISTRADO';}
    else if(i==-58)
    {descripcion = 'ESTA INSTITUCIÓN YA ESTÁ REGISTRADA';}
    else if(i==-59)
    {descripcion = 'ESTA FACULTAD YA ESTÁ REGISTRADA';}
    else if(i==-60)
    {descripcion = 'ESTA CARRERA YA ESTÁ REGISTRADA';}
    

    else if(i==-100)
    {descripcion = 'ERROR CONSULTA A BD';}
    else if(i==-101)
    {descripcion = 'NO SE HAN ENCONTRADO RESULTADOS DE BÚSQUEDA';}
    else if(i==-102)
    {descripcion = 'ERROR AL REGISTRAR EN BD';}
    else if(i==-105)
    {descripcion = 'USUARIO NO ENCONTRADO';}
    else if(i==-106)
    {descripcion = 'TIPO DE USUARIO NO ENCONTRADO';}
    else if(i==-107)
    {descripcion = 'ERROR AL ELIMINAR DE BD';}
    else if(i==-108)
    {descripcion = 'ERROR AL ACTUALIZAR EN BD';}
    return [i,descripcion]
}