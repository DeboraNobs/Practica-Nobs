<?php
    include_once '../../models/CartaBD.php';

    $mensaje = "";

    try {
        // Instanciar la clase CartaBD
        $cartaBD = new CartaBD();

        // Obtener configuraciones
        $config = $cartaBD->obtenerConfiguracion();
        
        // Obtener las configuraciones
        $maxDefensa = $config['maxDefensa'];
        $maxAtaque = $config['maxAtaque'];

    } catch (PDOException $e) {
        echo "Error: no se pudo obtener la configuración " . $e->getMessage();
    }

    // Verifica si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibe los datos del formulario
        $nombre = $_POST['nombre'];
        $ataque = $_POST['ataque'];
        $defensa = $_POST['defensa'];
        $tipo = $_POST['tipo'];
        $nombreImagen = $_POST['nombreImagen'];
        $poderEspecial = $_POST['poderEspecial'];

        try {
            if ($ataque > $maxAtaque || $defensa > $maxDefensa) {
                $mensaje = "El ataque y/o defenda no puede superar los máximos. Maximo Ataque: " . $maxAtaque .  "Maximo Defensa: " . $maxDefensa;
            }
            elseif ($cartaBD->insertarCartas($nombre, $ataque, $defensa, $tipo, $nombreImagen, $poderEspecial)) {
                $mensaje = "Carta agregada correctamente.";
            } else {
                $mensaje = "Error al agregar la carta.";
            }

        } catch (PDOException $e) {
            $mensaje = "Error: no se pudo agregar la carta. " . $e->getMessage();
        }
    }
?>

<?php // SI NO HUBIERA QUE CONTROLAR LOS MAXIMOS DE ATAQUE Y DEFENSA ⬇️

    // $cartaInsertada = null;
    // $mensaje = "";

    // // Comprobar si se ha enviado el formulario
    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     if(!empty($_POST['nombre']) && !empty($_POST['ataque']) && !empty($_POST['defensa'])
    //         && !empty($_POST['tipo']) && !empty($_POST['nombreImagen']) && !empty($_POST['poderEspecial'])) {
                
    //         $nombre= $_POST['nombre'];
    //         $ataque= $_POST['ataque'];
    //         $defensa= $_POST['defensa'];
    //         $tipo= $_POST['tipo'];
    //         $nombreImagen= $_POST['nombreImagen'];
    //         $poderEspecial= $_POST['poderEspecial'];
            
    //         $bd = new CartaBD();
    //         $cartaInsertada = $bd->insertarCartas($nombre, $ataque, $defensa, $tipo, $nombreImagen, $poderEspecial);
            
    //         if ($cartaInsertada) {
    //             $mensaje = "Carta insertada exitosamente";
    //         } else {
    //             $mensaje = "Hubo un error al insertar la carta";
    //         }

    //     } else {
    //         $mensaje = "Complete todos los campos de la tabla cartas";
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css"> 
</head>
<body>
<header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
            <li><a href="../dashboard.php">Inicio</a></li>
                <li><a href="../users/users.php">Usuarios</a></li>
                <li><a href="./cards.php">Cartas</a></li>
                <li><a href="../config/configuracion.php">Configuración</a></li>
                <li><a href="../logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Carta</h2>
            <p><?php echo $mensaje; ?></p> <!-- Mostrar el mensaje aquí -->
            
            <form action="" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>

                <label for="ataque">Ataque:</label>
                <input type="text" name="ataque" id="ataque" required>

                <label for="defensa">Defensa:</label>
                <input type="text" name="defensa" id="defensa" required>

                <label for="tipo">Tipo:</label>
                <input type="text" name="tipo" id="tipo" required>

                <label for="nombreImagen">Nombre Imagen:</label>
                <input type="text" name="nombreImagen" id="nombreImagen" required>

                <label for="poderEspecial">Poder Especial:</label>
                <input type="text" name="poderEspecial" id="poderEspecial" required>

                <button type="submit">Añadir Carta</button>
            </form>

        </div>
        </section>
    </main>
</body>
</html>