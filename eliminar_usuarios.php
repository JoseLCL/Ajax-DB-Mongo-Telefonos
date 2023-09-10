<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>

<?php
               
try{
    /*Abre la conexion con el servidor de la BD*/             
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');

    $bulk = new \MongoDB\Driver\BulkWrite;

    $filter = [];
    $bulk->delete($filter);

    $result = $conexion->executeBulkWrite('BD_Moviles.Celular', $bulk);
}catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage().PHP_EOL;
}
?>

</body>

</html>
