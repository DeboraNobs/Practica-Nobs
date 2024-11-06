<?php
    require_once 'header.php';
?>

    <main>
        <section class="dashboard-info">
            <h2>Información del juego</h2>
            <p><u>Número total de cartas:</u>  <?php echo $totalCartas ?> </p>
            <p> <u>Número total de usuarios:</u> <?php echo $totalUsuarios ?> </p>

            <p> <u>Configuración actual del juego: </u></p>
                <ul>
                    <li>Número máximo de cartas: <?php echo $num_cartas ?>  </li>
                    <li>Máxima defensa: <?php echo $max_defensa ?> </li>
                    <li>Máximo ataque: <?php echo $max_ataque ?> </li>
                </ul>

        </section>
    </main>

<?php include_once 'footer.php'; ?>
