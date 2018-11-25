<?php
function validarRut($rut)
{
    $rut = str_replace(".", "", $rut);
    $rut = str_replace("-", "", $rut);
    $rut = preg_replace('/[^k0-9]/i', '', $rut);
    $dv  = strtoupper(substr($rut, -1));
    $numero = substr($rut, 0, strlen($rut)-1);
    if(substr_count($numero,"k")>0)
    {
        return false;
    }

    $i = 2;
    $suma = 0;
    foreach(array_reverse(str_split($numero)) as $v)
    {
        if($i==8)
            $i = 2;
        $suma += $v * $i;
        ++$i;
    }
    $dvr = 11 - ($suma % 11);
    
    if($dvr == 11)
        $dvr = 0;
    if($dvr == 10)
        $dvr = 'K';
    if($dvr == $dv)
        return true;
    else
        return false;
}

function validarNombre($nombre)
{
    $valido = False;
    if(strlen($nombre)>=3 && strlen($nombre)<=100)
    {
         if (preg_match("/[a-zA-Z ñÑáÁéÉíÍóÓúÚüÜ]{3}/", $nombre)) { 
            $valido = True;
         }
    }
    return $valido;
}

function validarTexto($texto)
{
    $valido = False;
    if(strlen($texto)>=1 && strlen($texto)<=300)
    {
         if (preg_match("/[0-9a-z A-ZñÑáÁéÉíÍóÓúÚüÜ]{1}/", $texto)) { 
            $valido = True;
         }
    }
    return $valido;
}

function validarCorreo($correo)
{
    $valido = False;
    if(strlen($correo)>=3 && strlen($correo)<=50)
    {
        if (filter_var($correo, FILTER_VALIDATE_EMAIL))
        {  $valido = True;   }
    }
    return $valido;
}

function formatoPeso($x){
    $x = (string)$x; 
    $v = '$';
    for ($i = 0; $i < strlen($x) ; $i++) {
        $v.=$x[$i];
        if((strlen($x)-$i)%3==1 && $i!=strlen($x)-1)
        {$v.="."; }
    }
    return $v;
}

function validarTipoUsuario($x){
    $valido = False;
    if(is_numeric($x))
    {
        if($x>0 && $x<=5)
        {$valido = True;}
        else
        {$valido = False;}
    }
    else
        {$valido = False;}   
    return $valido;
}

function validarNumero($x){
    $valido = False;
    if(is_numeric($x))
    {$valido = True;}
    else
    {$valido = False;}   
    return $valido;
}

function validarSexo($x){
    if($x=='MASCULINO' || $x=='FEMENINO')
    {return True;}
    else
    {return False;}
}

function validarEstado($x){
    if($x=='PENDIENTE' || $x=='HABILITADO' || $x=='DESHABILITADO')
    {return True;}
    else
    {return False;}
}

function todoMayuscula($x){
    $x = strtoupper($x);
    $x = str_replace('á', 'Á', $x);
    $x = str_replace('é', 'É', $x);
    $x = str_replace('í', 'Í', $x);
    $x = str_replace('ó', 'Ó', $x);
    $x = str_replace('ú', 'Ú', $x);
    $x = str_replace('ñ', 'Ñ', $x);
    $x = str_replace('ä', 'Ä', $x);
    $x = str_replace('ë', 'Ë', $x);
    $x = str_replace('ï', 'Ï', $x);
    $x = str_replace('ö', 'Ö', $x);
    $x = str_replace('ü', 'Ü', $x);
    return $x;
}

function todoMinuscula($x){
    $x = strtoupper($x);
    $x = str_replace('Á', 'á', $x);
    $x = str_replace('É', 'é', $x);
    $x = str_replace('Í', 'í', $x);
    $x = str_replace('Ó', 'ó', $x);
    $x = str_replace('Ú', 'ú', $x);
    $x = str_replace('Ñ', 'ñ', $x);
    $x = str_replace('Ä', 'ä', $x);
    $x = str_replace('Ë', 'ë', $x);
    $x = str_replace('Ï', 'ï', $x);
    $x = str_replace('Ö', 'ö', $x);
    $x = str_replace('Ü', 'ü', $x);
    return $x;
}
?>