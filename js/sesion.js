$(document).ready(function() {
});


function iniciar_sesion()
{
    u = '', c = '';
    if($("#usuario").length)
    {u = $("#usuario").val();}
    if($("#password").length)
    {  c= $("#password").val();}
	form = $("#formLog").html();
	$('#formLog').html('<div class="container-fluid text-center d-flex align-items-center" style="height:150px;"><img src="../img/iconos/loading.gif" title="CARGANDO" width="100px" style="margin:auto"></div>');
    var url="../datos/autenticar.php";
    $.ajax({
        type:"POST",
        url:url,
        data:{usuario:u, clave:c},
        success: function(data)
        {
            if(data == 1)
            {setTimeout(redireccion_inicio,2000);}
            else
            {
            	$('#formLog').html(form);
                $('#infosesion').html(mostrarMensaje(listadoMensajes(data)));
                $("#usuario").val(u); $("#password").val(c);
                focusUsuario();
            }
        } 
    });
}

function redireccion_inicio(){window.location.href = "/hmapp/home/";}
function redireccion(x){window.location.href = x;}

function focusUsuario()     {   $('#usuario').focus();  }
function focusClave()       {   $('#password').focus(); }