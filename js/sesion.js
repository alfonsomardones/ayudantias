$(document).ready(function() {
    $("#btn-ini-sesion").click(function() {
        iniciar_sesion();
    });
});


function iniciar_sesion()
{
    $('#infosesion').innerHTML = '<img src="../img/iconos/loading.gif" title="CARGANDO" width="50px" style="margin:auto">';
    u = '', c = '';
    if($("#usuario").length)
    {u = $("#usuario").val();}
    if($("#password").length)
    {  c= $("#password").val();}
    var url="../datos/autenticar.php";
    $.ajax({
        type:"POST",
        url:url,
        data:{usuario:u, clave:c},
        success: function(data)
        {
            $('#infosesion').html(mostrarMensaje(listadoMensajes(data)));
            if(data == 1)
            {
                $('#formLog').html('<div class="container-fluid text-center d-flex align-items-center" style="height:150px;"><img src="../img/iconos/loading.gif" title="CARGANDO" width="100px" style="margin:auto"></div>');
                setTimeout(redireccion_inicio,2000);
            }
        } 
    });
}

function redireccion_inicio(){window.location.href = "/hmapp/home/";}
function redireccion(x){window.location.href = x;}