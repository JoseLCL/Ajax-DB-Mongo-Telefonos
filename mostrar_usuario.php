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
    $options = [
        'sort' => ['id' => 1], // Ordenar por id en orden ascendente (1)
    ];

    $query = new \MongoDB\Driver\Query($filter, $options);
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
            <th>Editar</th>
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
                echo "<td>";
                // Agrega un enlace a la página de edición con el ID del registro
                echo "<a href='editar_form.php?id=" . $doc->id . "'>Editar</a>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";

}catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage().PHP_EOL;
}
?>

</body>

</html>
