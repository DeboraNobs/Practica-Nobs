<?php
    require_once '../models/CartaBD.php';
    require_once '../models/UsuarioBD.php';

    $cartaBD = new CartaBD();
    $usuarioBD = new UsuarioBD();

    $cartas = $cartaBD->obtenerCartas(); // Obtener todas las cartas
    $totalCartas = count($cartas); // Contar total de cartas

    $usuarios = $usuarioBD->obtenerUsuarios();
    $totalUsuarios = count($usuarios);
    $configuracion = $cartaBD->obtenerConfiguracion(); // Obtener configuración actual

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="./assets/css/admin.css"> 
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Inicio</a></li>
                <li><a href="./users/users.php">Usuarios</a></li>
                <li><a href="./cards/cards.php">Cartas</a></li>
                <li><a href="./config/configuracion.php">Configuración</a></li>
                <li><a href="./logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-info">
            <h2>Información del juego</h2>
            <p><u>Número total de cartas:</u>  <?php echo $totalCartas ?> </p>
            <p> <u>Número total de usuarios:</u> <?php echo $totalUsuarios ?> </p>

            <p> <u>Configuración actual del juego: </u></p>
                <ul>
                    <li>Número de cartas: <?php echo $configuracion['numCartas']; ?></li>
                    <li>Máxima defensa: <?php echo $configuracion['maxDefensa']; ?></li>
                    <li>Máximo ataque: <?php echo $configuracion['maxAtaque']; ?></li>
                </ul>

        </section>


    </main>

</body>
</html>
