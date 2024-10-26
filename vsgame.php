<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POOVSGAME</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    
    <div id="contenido">
        <?php
            include './inc/jugador.php';
            session_start();

            // Inicializar sesión si no existe
            if (!isset($_SESSION['juego']) || !isset($_SESSION['rondaActual'])) {
                $juego = new Juego(10, 100, 100); 
                $_SESSION['juego'] = $juego;
                $_SESSION['rondaActual'] = 1;
                $_SESSION['jugador1'] = new Jugador("Manuel", $juego);
                $_SESSION['jugador2'] = new Jugador("Fran", $juego);
                $_SESSION['puntuacionJug1'] = 0;
                $_SESSION['puntuacionJug2'] = 0;
            }

            // Recuperar datos de sesión
            $juego = $_SESSION['juego'];
            $jugador1 = $_SESSION['jugador1'];
            $jugador2 = $_SESSION['jugador2'];
            $rondaActual = $_SESSION['rondaActual'];
            $puntuacionJug1 = $_SESSION['puntuacionJug1'];
            $puntuacionJug2 = $_SESSION['puntuacionJug2'];

            // Solo ejecutar si el jugador ha seleccionado una acción
            if (isset($_GET['accion'])) {
                $accionJugador1 = $_GET['accion'];

                // Obtener una carta para cada jugador
                $cartaJug1 = $jugador1->jugarCarta();
                $cartaJug2 = $jugador2->jugarCarta();

                if ($cartaJug1 !== null && $cartaJug2 !== null) { 
                    // Acceder a los valores de ataque y defensa de cada carta
                    $valorAtaqueJug1 = $cartaJug1->getAtaque();
                    $valorDefensaJug1 = $cartaJug1->getDefensa();
                    $valorAtaqueJug2 = $cartaJug2->getAtaque();
                    $valorDefensaJug2 = $cartaJug2->getDefensa();

                    // Mostrar cartas con los valores
                    echo "<div id='cartas'>";
                    echo "<img src='./imagenesDinamicas.php?ataque=$valorAtaqueJug1&defensa=$valorDefensaJug1' alt='Carta Jugador 1'>";
                    echo "<img src='./imagenesDinamicas.php?ataque=$valorAtaqueJug2&defensa=$valorDefensaJug2' alt='Carta Jugador 2'>";
                    echo "</div>";

                    echo "<h1>Ronda Número $rondaActual:</h1>";
                    echo "<u><strong>Jugador 1</strong></u> " . $jugador1->getNombre() . "<br>";
                    echo "<u><strong>Jugador 2</strong></u> " . $jugador2->getNombre() . "<br>";

                    echo "<h4>Acción elegida por el Jugador 1: $accionJugador1</h4>";

                    if ($accionJugador1 === 'atacar') {
                        if ($cartaJug1->getAtaque() > $cartaJug2->getAtaque()) {
                            echo "Jugador 1 gana esta ronda (Ataque)!<br>";
                            $_SESSION['puntuacionJug1']++;
                        } else {
                            echo "Jugador 2 gana esta ronda (Ataque)!<br>";
                            $_SESSION['puntuacionJug2']++;
                        }
                        echo "Carta Ataque (Jugador 1) => " . $cartaJug1->getAtaque() . "<br>";
                        echo "Carta Ataque (Jugador 2) => " . $cartaJug2->getAtaque() . "<br>";
                    } elseif ($accionJugador1 === 'defender') {
                        if ($cartaJug1->getDefensa() > $cartaJug2->getDefensa()) {
                            echo "Jugador 1 gana esta ronda (Defensa)!<br>";
                            $_SESSION['puntuacionJug1']++;
                        } else {
                            echo "Jugador 2 gana esta ronda (Defensa)!<br>";
                            $_SESSION['puntuacionJug2']++;
                        }
                        echo "Carta Defensa (Jugador 1) => " . $cartaJug1->getDefensa() . "<br>";
                        echo "Carta Defensa (Jugador 2) => " . $cartaJug2->getDefensa() . "<br>";
                    }

                    echo "<h3>Puntuación actual:</h3>";
                    echo "Jugador 1: $puntuacionJug1<br>";
                    echo "Jugador 2: $puntuacionJug2<br>";

                    $_SESSION['rondaActual']++;

                    // Verificar si se han alcanzado las rondas máximas o si se han terminado las cartas
                    if ($_SESSION['rondaActual'] > $juego->getNumCartas() || $cartaJug1 === null || $cartaJug2 === null) {
                        echo "<h3>¡Juego terminado!</h3>";
                        if ($puntuacionJug1 > $puntuacionJug2) {
                            echo "<h3>Jugador 1 => " . $jugador1->getNombre() . " gana el juego!</h3>";
                        } elseif ($puntuacionJug1 < $puntuacionJug2) {
                            echo "<h3>Jugador 2 => " . $jugador2->getNombre() . " gana el juego!</h3>";
                        } else {
                            echo "<h3>El juego termina en empate!</h3>";
                        }
                        session_destroy();
                        // exit;
                    }
                }
            }
        ?>
    </div>

    <form method="GET">
        <label for="accion">Selecciona tu acción:</label>
        <select name="accion" id="accion">
            <option value="atacar">Atacar</option>
            <option value="defender">Defender</option>
        </select>
        <button type="submit">Enviar</button>
    </form>

    <form method="POST">
        <button type="submit" name="reiniciar" onclick="return confirm('¿Estás seguro de que quieres reiniciar el juego?');">
            Reiniciar Juego
        </button>
    </form>

    <?php
        if (isset($_POST['reiniciar'])) {    
            session_unset();
            header("Location: vsgame.php");
        }
        return;
    ?>

</body>
</html>
