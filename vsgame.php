<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POOVSGAME</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div id="cartas">
        <img src="img/cards/<?php echo rand(1, 30); ?>_card.jpg" alt="Carta del Jugador">
        <img src="img/cards/<?php echo rand(1, 30); ?>_card.jpg" alt="Carta de la Máquina">
    </div>

    <div id="contenido">
    <?php
        include './inc/jugador.php';

        session_start(); 

        // Verificar si la sesión se ha inicializado correctamente
        // Si no existe el jugador en la sesion crea una nueva sesion, sino devuelve las variables de los jugadores creados
        
        if (!isset($_SESSION['juego']) || !isset($_SESSION['rondaActual'])) {
            // Inicialización de valores solo la primera vez
            $juego = new Juego(10, 100, 100); 
            $_SESSION['juego'] = $juego;
            $_SESSION['rondaActual'] = 1; // Empezamos en la primera ronda
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

        if (isset($_GET['accion'])) {   // Comprobar si se ha enviado el formulario
            $accionJugador1 = $_GET['accion'];
            
            $cartaJug1 = $jugador1->jugarCarta();
            $cartaJug2 = $jugador2->jugarCarta();

            echo "<h1>Ronda Número $rondaActual:</h1>";
            echo "<u> <strong> Jugador 1 </strong> </u> " . $jugador1->getNombre() . " <br>";
            echo "<u> <strong> Jugador 2 </strong> </u> " . $jugador2->getNombre() . " <br> ";

            echo "<h4> Acción elegida por el Jugador 1: $accionJugador1 </h4>";

            if ($accionJugador1 === 'atacar') {
                if ($cartaJug1->getAtaque() > $cartaJug2->getAtaque()) {
                    echo "Jugador 1 gana esta ronda (Ataque)! <br>";
                    $_SESSION['puntuacionJug1']++;
                } else {
                    echo "Jugador 2 gana esta ronda (Ataque)! <br>";
                    $_SESSION['puntuacionJug2']++;
                }
                echo "Carta Ataque (Jugador 1) => " . $cartaJug1->getAtaque() . " <br>";
                echo "Carta Ataque (Jugador 2) => " . $cartaJug2->getAtaque() . " <br>";

            } elseif ($accionJugador1 === 'defender') {
                if ($cartaJug1->getDefensa() > $cartaJug2->getDefensa()) {
                    echo "Jugador 1 gana esta ronda (Defensa)! <br>";
                    $_SESSION['puntuacionJug1']++;
                } else {
                    echo "Jugador 2 gana esta ronda (Defensa)! <br>";
                    $_SESSION['puntuacionJug2']++;
                }
                echo "Carta Defensa (Jugador 1) => " . $cartaJug1->getDefensa() . " <br>";
                echo "Carta Defensa (Jugador 2) => " . $cartaJug2->getDefensa() . " <br>";
            }

            echo "<h3>Puntuación actual:</h3>";
            echo "Jugador 1: $puntuacionJug1<br>";
            echo "Jugador 2: $puntuacionJug2<br>";

            $_SESSION['rondaActual']++;     // para avanzar de ronda

            if ($_SESSION['rondaActual'] > $juego->getNumCartas()) { // si se han jugado todas las rondas
                echo "<h3>¡Juego terminado!</h3>";
                if ($puntuacionJug1 > $puntuacionJug2) {
                    echo "<h3>Jugador 1 =>" . $jugador1->getNombre() . " gana el juego!</h3>";
                } elseif ($puntuacionJug1 < $puntuacionJug2) {
                    echo "<h3>Jugador 2 =>" . $jugador2->getNombre() . " gana el juego!</h3>";
                } else {
                    echo "<h3>El juego termina en empate!</h3>";
                }

                session_destroy();
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
