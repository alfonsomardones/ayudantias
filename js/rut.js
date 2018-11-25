$(document).ready(function() {
});

function limpiarRut(e){
    var key = e.charCode;
    if((key >= 48 && key <= 57) || key==0 || key==107  || key==75  || key==46)
    {}
    else
    {   return false;    }
}


function formateaRut(x) {
    if($(x).length)
    {
        rut = $(x).val();
        var actual = rut.replace(/^0+/, "");
        if (actual != '' && actual.length > 1) {
            var sinPuntos = actual.replace(/\./g, "");
            var actualLimpio = sinPuntos.replace(/-/g, "");
            var inicio = actualLimpio.substring(0, actualLimpio.length - 1);
            var rutPuntos = "";
            var i = 0;
            var j = 1;
            for (i = inicio.length - 1; i >= 0; i--) {
                var letra = inicio.charAt(i);
                rutPuntos = letra + rutPuntos;
                if (j % 3 == 0 && j <= inicio.length - 1)
                {rutPuntos = "." + rutPuntos; }
                j++;
            }
            var dv = actualLimpio.substring(actualLimpio.length - 1);
            rutPuntos = rutPuntos + "-" + dv;
            $(x).val(rutPuntos);
        }
    }
}

function verificarRut(rut) {
    if(rut.length>6)
    {
        // Despejar Puntos
        valor = rut.replace('.','');
        // Despejar Guión
        valor = valor.replace('-','');
        valor = valor.replace('.','');
        
        // Aislar Cuerpo y Dígito Verificador
        cuerpo = valor.slice(0,-1);
        dv = valor.slice(-1).toUpperCase();
        
        // Formatear RUN
        rut = cuerpo + '-'+ dv
        // Si no cumple con el mínimo ej. (n.nnn.nnn)
        if(cuerpo.length < 7) {
            return false;
        }
        
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
            {
                multiplo = multiplo + 1;
            }
            else
            {
                multiplo = 2;
            }
      
        }
        
        // Calcular Dígito Verificador en base al Módulo 11
        dvEsperado = 11 - (suma % 11);
        
        // Casos Especiales (0 y K)
        dv = (dv == 'K')?10:dv;
        dv = (dv == 0)?11:dv;
        
        // Validar que el Cuerpo coincide con su Dígito Verificador
        if(dvEsperado == dv) {return true; }
        else
        {return false;}
    }
    else
    {
        return false;
    }
}