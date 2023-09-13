<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type="text/javascript" src="js/scriptIndex.js"></script>
</head>

<body>

    <h1>Editar Registro</h1>
    <form id="editarForm" method="POST">
    <?php
    $id = $_GET['id'];
        // Conecta a MongoDB (ajusta la conexión según tu configuración)
        $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');  
    
        // Define el filtro para buscar el registro por su ID
        $filtro=['id'=>(int)$id];
        $consulta = new MongoDB\Driver\Query($filtro);
    
        // Realiza la consulta en la colección correspondiente (ajusta el nombre de la colección)
        $resultado = $conexion->executeQuery('BD_Moviles.Celular', $consulta);
    
        // Recorre el resultado para obtener los datos del registro
        foreach ($resultado as $registro) {
            echo "<input type='hidden' name='idEditar' value='$id'>";
            echo "<input type='text' name='marca' value='" . $registro->marca . "' required>";
            echo "<input type='text' name='modelo' value='" . $registro->modelo . "' required>";
            echo "<input type='text' name='so' value='" . $registro->so . "' required>";
            echo "<input type='text' name='alm' value='" . $registro->alm . "' required>";
            echo "<input type='text' name='ram' value='" . $registro->ram . "' required>";
            echo "<input type='text' name='color' value='" . $registro->color . "' required>";
        }

    ?>
    <input type="submit" name="guardarEdicion" value="Guardar"onclick="return editarUsuario()">
</form>

</body>
</html>
