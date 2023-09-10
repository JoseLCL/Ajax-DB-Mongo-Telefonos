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
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $sistema = $_POST['so'];
    $almacenamiento = $_POST['alm'];
    $ram = $_POST['ram'];
    $color = $_POST['color'];

    // Verifica si se ha cargado una imagen
    if (!empty($_FILES['imagen']['tmp_name'])) {
        $imagen = $_FILES['imagen'];
        $imagen_temp = $imagen['tmp_name'];

    // Lee el contenido del archivo como un binario
        $imagen_binario = file_get_contents($imagen_temp);
    } else {
    // Si no se cargó ninguna imagen, asigna una imagen por defecto
        $imagen_binario = file_get_contents('default.png');
    }

    /*Abre la conexion con el servidor de la BD*/            
try{
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    //Prepara el comando
    $documento = [
        'id'=> $id,
        'marca' => $marca,
        'modelo'=> $modelo,
        'so' => $sistema,
        'alm' => $almacenamiento,
        'ram'=> $ram,
        'color'=> $color,
        'imagen' => new MongoDB\BSON\Binary($imagen_binario, MongoDB\BSON\Binary::TYPE_GENERIC),
    ];
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($documento);

    // Realiza la consulta
    $conexion->executeBulkWrite('BD_Moviles.Celular', $bulk); //Si no existen los crea
}catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage().PHP_EOL;
}
?>

</body>

</html>
