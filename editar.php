
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<?php
try {
    // Conecta a MongoDB
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');


    $id = intval($_POST['idEditar']);
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $so = $_POST['so'];
    $alm = $_POST['alm'];
    $ram = $_POST['ram'];
    $color = $_POST['color'];

    
    $filtro = ['id' => $id];

    $actualizaciones = [
        '$set' => [
            'marca' => $marca,
            'modelo' => $modelo,
            'so' => $so,
            'alm' => $alm,
            'ram' => $ram,
            'color' => $color
        ]
    ];

    $opciones = ['upsert' => false];

    $actualizacion = new MongoDB\Driver\BulkWrite();
    $actualizacion->update($filtro, $actualizaciones, $opciones);

    $conexion->executeBulkWrite('BD_Moviles.Celular', $actualizacion);

} catch (Throwable $e) {
    echo "Error al actualizar el usuario: " . $e->getMessage();
}
