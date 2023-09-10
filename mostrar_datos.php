<?php
// Conexión a MongoDB
try {
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');

    // Consulta para obtener todos los documentos de la colección "Celular"
    $query = new MongoDB\Driver\Query([]);
    $result = $conexion->executeQuery('BD_Moviles.Celular', $query);

    // Genera el código HTML para mostrar los datos y las imágenes
    foreach ($result as $documento) {
        $id = $documento->id;
        $marca = $documento->marca;
        $modelo = $documento->modelo;
        $so = $documento->so;
        $alm = $documento->alm;
        $ram = $documento->ram;
        $color = $documento->color;
        $imagen_binario = $documento->imagen->getData();
        $imagen_base64 = base64_encode($imagen_binario);

        // Genera el HTML para mostrar el documento y la imagen
        echo "<div class='celular'>";
        echo "<p>ID: $id</p>";
        echo "<p>Marca: $marca</p>";
        echo "<p>Modelo: $modelo</p>";
        echo "<p>Sistema Operativo: $so</p>";
        echo "<p>Almacenamiento: $alm</p>";
        echo "<p>Memoria RAM: $ram</p>";
        echo "<p>Color: $color</p>";
        echo "<img src='data:image/jpeg;base64,$imagen_base64' alt='Imagen del dispositivo'>";
        echo "</div>";
    }
} catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>