<!DOCTYPE html>
<html lang="en">

<body>

    <?php
    //Obtiene el valor enviado
    $q = intval($_GET['q']);
    /*Abre la conexion con el servidor de la BD */
    try {
        /*Abre la conexion con el servidor de la BD*/
        $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');

        $filter = ['id' => (int)$q];

        $query = new \MongoDB\Driver\Query($filter);
        $cursor = $conexion->executeQuery('BD_Moviles.Celular', $query);

        // Genera el código HTML para mostrar los datos y las imágenes
        foreach ($cursor as $documento) {
            $marca = $documento->marca;
            $modelo = $documento->modelo;
            $so = $documento->so;
            $alm = $documento->alm;
            $ram = $documento->ram;
            $color = $documento->color;
            $imagen_binario = $documento->imagen->getData();
            $imagen_base64 = base64_encode($imagen_binario);

            // Genera el HTML para mostrar el documento y la imagen
            echo "<div class='resultadoCelular'>";
            echo "<h2> <b>Informaci&oacuten del equipo</b> </h2>";
            echo "<div class='columnaDatos'>";
            echo "<p><b>Marca:</b> $marca</p>";
            echo "<p><b>Modelo:</b> $modelo</p>";
            echo "<p><b>Sistema Operativo:</b> $so</p>";
            echo "<p><b>Almacenamiento:</b> $alm</p>";
            echo "<p><b>Memoria RAM:</b> $ram</p>";
            echo "<p><b>Color:</b> $color</p>";
            echo "</div>";
            echo "<img src='data:image/jpeg;base64,$imagen_base64'>";
            echo "</div>";
        }
    } catch (Throwable $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
    ?>

</body>

</html>