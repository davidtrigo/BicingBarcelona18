<h1>Buscador de estaciones de bicing</h1>
<form action="" method="get">
    <div class="form-group">
        <div>
            <label><b>Longitud</b></label> <input  class="form-control" type="text" size="10" name="longitud" value="2.1592225"/>
            <label>Anote la longitud p.e. 2.1592225</label>
        </div>
        <div>
            <label><b>Latitud</b></label> <input class="form-control" type="text" size="20" name="latitud" value="41.3807313"/>
      		<label>Anote la latitud p.e. 41.3807313</label>
        </div>
        <div>
            <label><b> Distancia maxima(km)</b></label> <input class="form-control" size='15' min="0" name="distancia" value="0.500"/>
            <label>Anote la distancia en km p.e. 0.500</label>
        </div>
        
        <div>
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
</form>
<?php
require_once "ControllerStations.php";
$array = ControllerStation::getStations();
if (!empty($array)) {
    echo "</table>";
    if (isset($array)) {
        echo "<table class='table'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Tipo de estacion</th>";
        echo "<th>Calle</th>";
        echo "<th>Distancia</th>";
        echo "<th>Detalles</th>";
        echo "</tr>";
        echo "</thead>";
        echo "</tbody>";
        foreach ($array as $station) {  //recorrrido 
            $distancia = round($station['distancia'], 3);
            echo "<tr>";
            echo " <td>{$station['type']} </td>";
            echo " <td>{$station['streetName']}, {$station['streetNumber']} </td>";
            echo " <td>$distancia</td>";
            echo " <td><a href=detalles.php?id={$station['id']}>Detalles de la estacion {$station['id']}</a></td>";
            echo "</tr>";
        }


    }
}

?>
</tbody>
</table>

