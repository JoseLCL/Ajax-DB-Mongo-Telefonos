<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

<?php
    $id = intval($_POST['id']);                         
    $nombre = $_POST['nom'];
    $apellido = $_POST['ap'];
    $edad = intval($_POST['ed']);
    $nacimiento = $_POST['nac'];
    $trabajo = $_POST['trab'];
    /*Abre la conexion con el servidor de la BD*/            
try{
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    //Prepara el comando
    $documento = [
        'id'=> $id,
        'nombre' => $nombre,
        'apellido'=> $apellido,
        'edad' => $edad,
        'nacimiento' => $nacimiento,
        'trabajo'=> $trabajo
    ];
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($documento);

    // Realiza la consulta
    $conexion->executeBulkWrite('MiBD_PHP.MiColeccion', $bulk); //Si no existen los crea
}catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage().PHP_EOL;
}
?>

</body>

</html>
