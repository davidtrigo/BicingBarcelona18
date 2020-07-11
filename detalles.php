<?php
//include "buscador.php";
require_once "ControllerStations.php";
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <title>Bicing Barcelona 2018</title>
</head>
<body>
<div class="container">

    <nav class="navbar">
        <a href ="index.php" class="navbar-brand"> <img src="img/log-bicing.png"class="d-inline-block align-top" alt=""></a>
    </nav>
    <?php include "buscador.php";?>

    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $array = ControllerStation::getStation($id);
        if ($array != null) {
            echo " <h1>Detalles de la estacion $id </h1>";

            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Tipo de estaci�n</th>";
            echo "<th>Calle</th>";
            echo "<th>slots disponibles</th>";
            echo "<th>Bicis disponibles</th>";
            echo "<th>Estado</th>";
            echo "<th>Latitud</th>";
            echo "<th>Longitud</th>";
            echo "<th>altitude</th>";
            echo "</tr>";
            echo "</thead>";
            echo "</tbody>";
            foreach ($array as $station) {
                echo "<tr>";
                echo " <td>{$station['type']} </td>";
                echo " <td>{$station['streetName']}, {$station['streetNumber']} </td>";
                echo " <td>{$station['slots']}</td>";
                echo " <td>{$station['bikes']}</td>";
                echo " <td>{$station['status']}</td>";
                echo " <td>{$station['latitude']}</td>";
                echo " <td>{$station['longitude']}</td>";
                echo " <td>{$station['altitude']}</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "<div>";

            $nearbyStations = $station['nearbyStations']; // estaciones cercanas
            $stations = explode(',', $nearbyStations);

            $nearbyStationsDetails = ControllerStation::getNearStations($stations);

            echo "<h1>Estaciones cercanas</h1>";
            echo "<table class='table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Numero de estaci�n</th>";
            echo "<th>Tipo de estaci�n</th>";
            echo "<th>Calle</th>";
            echo "<th>Detalles</th>";
            echo "</tr>";
            echo "</thead>";
            echo "</tbody>";
            foreach ($nearbyStationsDetails as $station) {
                echo "<tr>";
                echo " <td>{$station['id']} </td>";
                echo " <td>{$station['type']} </td>";
                echo " <td>{$station['streetName']}, {$station['streetNumber']} </td>";
                echo " <td><a href=detalles.php?id={$station['id']}>Detalles</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        }
    }

    ?>


</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
        integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
        integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
        crossorigin="anonymous"></script>
</body>
</html>