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
    $cursor = $conexion->executeQuery('MiBD_PHP.MiColeccion', $query);



                 
    /*************  Genera la tabla respuesta ************************/
    echo "<table>
        <tr>
            <th>Nombre</th>
            <th>Apellido</th>   
            <th>Edad</th>
            <th>Nacimiento</th>
            <th>Tabajo</th>
        </tr>";

        // Obtiene cada fila (arreglo) de resultados
        foreach ($cursor as $doc) {  
            echo "<tr>";
                echo "<td>" . $doc->nombre . "</td>";
                echo "<td>" . $doc->apellido . "</td>";
                echo "<td>" . $doc->edad . "</td>";
                echo "<td>" . $doc->nacimiento . "</td>";
                echo "<td>" . $doc->trabajo . "</td>";
            echo "</tr>";
        }
    echo "</table>";
    
}catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage().PHP_EOL;
}
?>

</body>

</html>
