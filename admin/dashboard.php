<?php
    require_once '../models/CartaBD.php';
    require_once '../models/UsuarioBD.php';
    require_once 'header.php';

    $cartaBD = new CartaBD();
    $usuarioBD = new UsuarioBD();

    $cartas = $cartaBD->obtenerCartas(); // Obtener todas las cartas
    $totalCartas = count($cartas); // Contar total de cartas

    $usuarios = $usuarioBD->obtenerUsuarios();
    $totalUsuarios = count($usuarios);

    $configuracion = $cartaBD->obtenerConfiguracion(); // obtener configuración actual
?>


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

<?php include_once 'footer.php'; ?>
