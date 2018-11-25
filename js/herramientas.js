$(document).ready(function() {

});

function DigitoVerificador(){
	rut = ''; dv = ''; dv 	= $('#rut_dv').val('');
	if($('#rut_v').length)		{	rut 	= $('#rut_v').val();}
	if($('#rut_dv').length)		{$('#rut_dv').val(obtenerDV(rut));}
}

function convertirMD5(){
    contenido = '';
    if($('#contenido_md5').length)      {    $('#contenido_md5').val('');}
    if($('#contenido_normal').length)   {   contenido  = $('#contenido_normal').val();}
    if(contenido.length>0)
    {
        url = 'convertir_md5.php';
        $.ajax({
            type:"POST",
            url:url,
            data:{contenido:contenido},
            success: function(data)
            {
                if(data!='')
                {if($('#contenido_md5').length)     {$('#contenido_md5').val(data);}}
            }
        });
    }
    
}

function obtenerDV(rut){
	dv = '';
	if(rut.length>6)
	{
		// Despejar Puntos
        valor = rut.replace('.','');
        // Despejar Guión
        valor = valor.replace('-','');
        // Aislar Cuerpo y Dígito Verificador
        cuerpo = valor;
        // Formatear RUN
        // Calcular Dígito Verificador
        suma = 0;
        multiplo = 2;
        // Para cada dígito del Cuerpo
        for(i=1;i<=cuerpo.length;i++) {
            // Obtener su Producto con el Múltiplo Correspondiente
            index = multiplo * valor.charAt(cuerpo.length - i);
            // Sumar al Contador General
            suma = suma + index;
            
            // Consolidar Múltiplo dentro del rango [2,7]
            if(multiplo < 7)
            { multiplo = multiplo + 1;  }
            else
            { multiplo = 2; }
        }
        
        // Calcular Dígito Verificador en base al Módulo 11
        dv = 11 - (suma % 11);
        // Casos Especiales (0 y K)
        if(dv == 10){ dv = 'K';}
        if(dv == 11){ dv = 0;}        
    }
    return dv;
}

function focusRutV()        {   $('#rut_v').focus();     }
function focusRutDV()        {   $('#rut_dv').focus();     }