<?php
/*Clase que calcula la distancia de dos puntos dando su latitudes y longitudes del primer y segundo punto.*/
class Utils
{
    function distanciaGeodesica($lat1, $long1, $lat2, $long2)
    {
        $degtorad = 0.01745329;
        $radtodeg = 57.29577951;

        $dlong = ($long1 - $long2);
        $dvalue = (sin($lat1 * $degtorad) * sin($lat2 * $degtorad))
            + (cos($lat1 * $degtorad) * cos($lat2 * $degtorad)
                * cos($dlong * $degtorad));
        $dd = acos($dvalue) * $radtodeg;
        $km = ($dd * 111.302);
        return $km;
    }
}
?>