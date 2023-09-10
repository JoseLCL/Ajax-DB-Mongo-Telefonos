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
            text-align: center;
            border-collapse: collapse;
            font-size: 18px;
        }
        table, td, th {
            border: none;
            padding: 20px;
        }
        th {           
            background-color: wheat;
            border: 3px solid #000;
        }
        td{
            background-color: white;
            border-right: 3px solid #000;
         }
         tr:last-child{
            border-bottom: 3px solid #000;
         }
         td:first-child{
            border-left: 3px solid #000;
         }
    </style>
</head>

<body>

<?php
               
try{
    /*Abre la conexion con el servidor de la BD*/
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');             

    $filter=[];
    $query = new \MongoDB\Driver\Query($filter);
    $cursor = $conexion->executeQuery('MiBD_PHP.MiColeccion', $query);
                  

    /*************  Genera la tabla respuesta ************************/
    echo "<table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>   
            <th>Edad</th>
            <th>Lugar de Nacimiento</th>
            <th>Trabajo</th>
        </tr>";

        // Obtiene cada fila (arreglo) de resultados
        foreach ($cursor as $doc) {
            echo "<tr>";
                echo "<td>" . $doc->id . "</td>";
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
