<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, td, th {
            border: 1px solid black;
            padding: 5px;
        }

        th {
            text-align: left;
        }
    </style>
</head>

<body>

<?php
    //Obtiene el valor enviado
    $q = intval($_GET['q']);                              
    /*Abre la conexion con el servidor de la BD */
try{
    /*Abre la conexion con el servidor de la BD*/
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');             


    $filter=['id'=>(int)$q];
    $query = new \MongoDB\Driver\Query($filter);
    $cursor = $conexion->executeQuery('BD_Moviles.Celular', $query);
                 
    /*************  Genera la tabla respuesta ************************/
    echo "<table>
        <tr>
            <th>ID</th>
            <th>Marca</th>
            <th>Modelo</th>   
            <th>S.O.</th>
            <th>Almacenamiento</th>
            <th>Memoria RAM</th>
            <th>Color</th>
        </tr>";

        // Obtiene cada fila (arreglo) de resultados
        foreach ($cursor as $doc) {  
            echo "<tr>";
                echo "<td>" . $doc->id . "</td>";
                echo "<td>" . $doc->marca . "</td>";
                echo "<td>" . $doc->modelo . "</td>";
                echo "<td>" . $doc->so . "</td>";
                echo "<td>" . $doc->alm . "</td>";
                echo "<td>" . $doc->ram . "</td>";
                echo "<td>" . $doc->color . "</td>";
            echo "</tr>";
        }
    echo "</table>";
    
}catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage().PHP_EOL;
}
?>

</body>

</html>
