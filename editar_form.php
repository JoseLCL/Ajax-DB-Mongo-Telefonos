<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Modificar Registro</title>

    <script type="text/javascript" src="js/scriptIndex.js"></script>

    <!-- Incluye el CSS -->
    <link rel="stylesheet" href="./css/miCss.css">


    <!--GOOGLE FONTS (QUICKSAND) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    <style>
        #formularioContainer {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgb(244, 239, 239);
            border-radius: 10px;
            box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.3);
            padding: 1em;
            width: fit-content;
            margin: 0 auto;
            padding: 3em;
        }

        label {
            margin-bottom: 30px;
            display: block;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 18px;
        }

        input[type="text"] {
            width: 100%;
            margin-top: 10px;
            font-size: 16px;
            padding: 10px;
        }

        input[type="submit"] {
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            font-size: 16px;
            cursor: pointer;
            padding: 0.5em;
            font-size: 18px;
            border: 1px solid #000;
            text-transform: uppercase;
        }

        input[type="submit"]:hover,
        input[type="submit"]:focus {
            background: #dad1d1;
            font-weight: bold;
            transition: background-color 1s ease-out;
        }
    </style>

</head>

<body>

    <h1 style="text-align: center;"> Editar Registro </h1>
    <div id="formularioContainer">
        <form id="editarForm" method="POST" action="index.html">
            <?php
            $id = $_GET['id'];
            // Conecta a MongoDB (ajusta la conexión según tu configuración)
            $conexion = new MongoDB\Driver\Manager('mongodb://localhost:27017');

            // Define el filtro para buscar el registro por su ID
            $filtro = ['id' => (int)$id];
            $consulta = new MongoDB\Driver\Query($filtro);

            // Realiza la consulta en la colección correspondiente (ajusta el nombre de la colección)
            $resultado = $conexion->executeQuery('BD_Moviles.Celular', $consulta);

            // Recorre el resultado para obtener los datos del registro
            foreach ($resultado as $registro) {
                echo "<input type='hidden' name='idEditar' value='$id'>";
                // Crear un div para cada par de etiqueta y entrada, dividiéndolos en dos columnas
                echo "<label>Marca: <input type='text' name='marca' value='" . $registro->marca . "' required></label>";
                echo "<label>Modelo: <input type='text' name='modelo' value='" . $registro->modelo . "' required></label>";
                echo "<label>Sistema Operativo: <input type='text' name='so' value='" . $registro->so . "' required></label>";
                echo "<label>Almacenamiento: <input type='text' name='alm' value='" . $registro->alm . "' required></label>";
                echo "<label>RAM: <input type='text' name='ram' value='" . $registro->ram . "' required></label>";
                echo "<label>Color: <input type='text' name='color' value='" . $registro->color . "' required></label>";
            }

            ?>

            <div style="text-align: center;">
                <input type="submit" name="guardarEdicion" value="Guardar" onclick="return editarUsuario()">
            </div>
        </form>
        <a href="index.html"><button class="back">Volver a Registro</button></a>
    </div>

</body>

</html>