<?php
try{ 
    /*Abre la conexion con el servidor de la BD*/
    $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');             

    $filter=[];
    $query = new \MongoDB\Driver\Query($filter);
    $cursor = $conexion->executeQuery('BD_Moviles.Celular', $query);                  
   
    /*************  Genera la tabla respuesta ************************/
    echo "<form id='form'>
        <select name='users' id='seleccion' onchange='mifuncion()'> ";
            echo "<option disabled selected> Selecciona una opcion </option>";
            // Obtiene cada dato del select
            foreach ($cursor as $doc) {
                echo "<option value='" . $doc->id . "'>".$doc->modelo."</option>";
            }  

        echo "</select>";
    echo "</form>";
}catch (Throwable $e) {
    echo "Error de conexión: " . $e->getMessage().PHP_EOL;
}
?>