<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>

<?php
    $id = $_POST['id'];
    /*Abre la conexion con el servidor de la BD*/     
try{        
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');

    $bulk = new \MongoDB\Driver\BulkWrite;

    $filter = ['id' => (int)$id];
    $bulk->delete($filter);

    $result = $conexion->executeBulkWrite('BD_Moviles.Celular', $bulk);
}catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage().PHP_EOL;
}
?>

</body>

</html>
