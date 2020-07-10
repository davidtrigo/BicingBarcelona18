<?php
require_once "Utils.php";

class ControllerStation
{
    /** Retorna un array con los datos de las estaciones
     * @return array
     */
    function getStations()
    {
        $url = "http://wservice.viabicing.cat/v2/stations"; //json de bcn bicing
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $url);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
        $datos_llegada = curl_exec($con);
        curl_close($con);
        $stations = json_decode($datos_llegada, true);  //convierte json a string
        $select = $stations['stations'];
        if (!empty($_GET['latitud']) && !empty($_GET['longitud']) && !empty($_GET['distancia'])) {
          
            $latitudReal = $_GET['latitud'];
            $longitudReal = $_GET['longitud'];
            $distancia = $_GET['distancia'];
            $arraystationsNear = [];
            foreach ($select as $station) {
                $id = $station['id'];
                $type = $station['type'];
                $latitude = $station['latitude'];
                $longitude = $station['longitude'];
                $streetName = $station['streetName'];
                $streetNumber = $station['streetNumber'];
           //     $arraystations[] = array($id, $type, $streetName, $streetName);  //todas las estaciones en modo array
                //guardo la distancia de mi posicion a la de la estacion
                $resultKM = Utils::distanciaGeodesica($latitudReal, $longitudReal, $latitude, $longitude);
                if ($resultKM <= $distancia) {
                    $arraystationsNear [] = array('id' => "$id", 'streetName' => "$streetName", 'streetNumber' => "$streetNumber",
                        'type' => "$type", "distancia" => "$resultKM");
                }
            }return $arraystationsNear;
        } else {
            if (!empty($_GET['latitud']) || !empty($_GET['longitud']) || !empty($_GET['distancia'])) 
                     print ("todos los varios son obligatorios");
                    
                  
         
            /*
            if (empty ($_GET['latitud'])) print ("Latitud es un valor necesario")."<br>"; 
            if  (empty($_GET['longitud'])) print ("Longitud es un valor necesario")."<br>";
            if (empty ($_GET['distancia']))  print ("Distancia es un valor necesario")."<br>";
                    **/
            
           
        }
        return [];
    }

    /** Retorna un array con los datos de la estacion del id pasado por parametro
     * @param $idStation
     * @return array
     */
    function getStation($idStation)
    {
        $url = "http://wservice.viabicing.cat/v2/stations";
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $url);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
        $datos_llegada = curl_exec($con);
        curl_close($con);
        $stations = json_decode($datos_llegada, true);
        $select = $stations['stations'];
        $stationDetails = [];
        foreach ($select as $station) {
            $id = $station['id'];
            $type = $station['type'];
            $latitude = $station['latitude'];
            $longitude = $station['longitude'];
            $streetName = $station['streetName'];
            $streetNumber = $station['streetNumber'];
            $slots = $station['slots'];
            $altitude = $station['altitude'];
            $bikes = $station['bikes'];
            $nearbyStations = $station['nearbyStations'];
            $status = $station['status'];

            // si el id  es el mismo que el id pasado por paramentro
            if ($id == $idStation) {
                $stationDetails [] = array('id' => "$id", 'type' => "$type", 'latitude' => "$latitude",
                    'longitude' => "$longitude", 'streetName' => "$streetName",
                    'streetNumber' => "$streetNumber", 'slots' => "$slots", "altitude" => $altitude,
                    'bikes' => "$bikes", "nearbyStations" => "$nearbyStations", "status" => $status);
            }
        }
        return $stationDetails;
    }

    /**  Retorna un listado de estaciones cuyas ids sean iguales que el id pasado por parametro
     * @param $array
     * @return array
     */
    function getNearStations($array)
    {
        $url = "http://wservice.viabicing.cat/v2/stations";
        $con = curl_init();
        curl_setopt($con, CURLOPT_URL, $url);
        curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
        $datos_llegada = curl_exec($con);
        curl_close($con);
        $stations = json_decode($datos_llegada, true);
        $select = $stations['stations']; //todas las estaciones existentes

        foreach ($select as $station) {
            $id = $station['id'];
            $type = $station['type'];
            $streetName = $station['streetName'];
            $streetNumber = $station['streetNumber'];

            foreach ($array as $value) {
                if ($value == $id) {
                    $stationDetails [] = array('id' => "$id", 'type' => "$type", 'streetName' => "$streetName", 'streetNumber' => "$streetNumber");
                }
            }
        }
        return $stationDetails;

    }
}


?>