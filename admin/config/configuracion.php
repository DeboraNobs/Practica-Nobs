<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin.css"> <!-- Archivo CSS externo -->
    <title>Configuración del juego</title>
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
            <li><a href="../dashboard.php">Inicio</a></li>
                <li><a href="../admin/users/users.php">Usuarios</a></li>
                <li><a href="../cards/cards.php">Cartas</a></li>
                <li><a href="../config/configuracion.php">Configuración</a></li>
                <li><a href="../logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <h1>Formulario de configuración </h1>
    <form action="configuracion.php" method="post">
        <label for="numCartas">Número de cartas: </label>
        <input type="number" id="numCartas" name="numCartas" value="<?php if(isset($_POST['numCartas'])) echo $_POST['numCartas']?>"> <br>

        <?php 
            if(isset($_POST['enviar']) && empty($_POST['numCartas'])) { 
                echo "<span style='color:red'> --Es obligatorio introducir un número de cartas!</span> <br>"; 
            } 
        ?>

        <label for="maxDefensa">Número máximo de defensa: </label>
        <input type="number" name="maxDefensa" id="maxDefensa" value="<?php if(isset($_POST['maxDefensa'])) echo $_POST['maxDefensa'] ?>"> <br>

        <?php
            if(isset($_POST['enviar']) && empty($_POST['maxDefensa'])) {
                echo "<span style='color:red'> --Es obligatorio introducir un número máximo de defensa!</span> <br>"; 
            }
        ?>

        <label for="maxAtaque">Número máximo de ataque: </label>
        <input type="number" name="maxAtaque" id="maxAtaque" value="<?php if(isset($_POST['maxAtaque'])) echo $_POST['maxAtaque'] ?>"> <br>

        <?php
            if(isset($_POST['enviar']) && empty($_POST['maxAtaque'])) {
                echo "<span style='color:red'> --Es obligatorio introducir un número máximo de ataque!</span> <br>"; 
            }
        ?>

        <input type="submit" value="Introducir configuracion" name="enviar"> <br>

    </form>


    <?php
    require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/config/Conexion.php';


     // Procesar el formulario si se ha enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
        if (!empty($_POST['numCartas']) && !empty($_POST['maxDefensa']) && !empty($_POST['maxAtaque'])) {

            // Obtener los valores del formulario
            $numCartas = $_POST['numCartas'];
            $maxDefensa = $_POST['maxDefensa'];
            $maxAtaque = $_POST['maxAtaque'];

            // Consultas SQL preparadas para insertar o actualizar los valores
            $sql1 = "INSERT INTO configuracion (clave, valor) VALUES (:clave, :valor) ON DUPLICATE KEY UPDATE valor = :valor";
            $sql2 = "INSERT INTO configuracion (clave, valor) VALUES (:clave, :valor) ON DUPLICATE KEY UPDATE valor = :valor";
            $sql3 = "INSERT INTO configuracion (clave, valor) VALUES (:clave, :valor) ON DUPLICATE KEY UPDATE valor = :valor";

            try {
                // Crear una nueva conexión usando la clase Conexion
                $conexionObj = new Conexion();
                $conn = $conexionObj->get_conexion(); 

                // Preparar las consultas SQL
                $stmt1 = $conn->prepare($sql1);
                $stmt2 = $conn->prepare($sql2);
                $stmt3 = $conn->prepare($sql3);

                // Ejecutar la consulta para numCartas
                $stmt1->execute(['clave' => 'numCartas', 'valor' => $numCartas]);

                // Ejecutar la consulta para maxDefensa
                $stmt2->execute(['clave' => 'maxDefensa', 'valor' => $maxDefensa]);

                // Ejecutar la consulta para maxAtaque
                $stmt3->execute(['clave' => 'maxAtaque', 'valor' => $maxAtaque]);

                echo "<p>Configuración guardada correctamente.</p>";

            } catch (PDOException $e) {
                echo "Error: no se pudo conectar con la bbdd " . $e->getMessage();
            }

        } else {
            echo "<p style='color:red;'>Por favor, completa todos los campos.</p>";
        }
    }
    ?>

</body>
</html>

