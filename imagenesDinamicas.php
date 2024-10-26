<?php
    // obtener los valores de ataque y defensa de la URL
    $valorAtaque = isset($_GET['ataque']) ? intval($_GET['ataque']) : rand(1, 100);
    $valorDefensa = isset($_GET['defensa']) ? intval($_GET['defensa']) : rand(1, 100);

    $rutaImagen = './img/cards/' . rand(1, 30) . '_card.jpg';
    if (!file_exists($rutaImagen)) {
        die('Error: El archivo no existe.');
    }
    $cartaBase = imagecreatefromjpeg($rutaImagen);

    $rojo = imagecolorallocate($cartaBase, 200, 40, 40);
    $verde = imagecolorallocate($cartaBase, 40, 200, 40);
    $blanco = imagecolorallocate($cartaBase, 255, 255, 255);

    // Posiciones de círculos y texto
    $radio = 90;
    $centroX_ataque = 50;
    $centroY_ataque = imagesy($cartaBase) - 50;
    $centroX_defensa = imagesx($cartaBase) - 50;
    $centroY_defensa = imagesy($cartaBase) - 50;

    // Dibujar los círculos
    imagefilledellipse($cartaBase, $centroX_ataque, $centroY_ataque, $radio, $radio, $rojo);
    imagefilledellipse($cartaBase, $centroX_defensa, $centroY_defensa, $radio, $radio, $verde);

    $fuente = './fuentes/Fresco-Stamp.ttf';
    $tamanoFuente = 30;
    if (!file_exists($fuente)) {
        die('Error: La fuente no existe.');
    }

    // Escribir los valores de ataque y defensa
    imagettftext($cartaBase, $tamanoFuente, 0, $centroX_ataque - 10, $centroY_ataque + 8, $blanco, $fuente, $valorAtaque);
    imagettftext($cartaBase, $tamanoFuente, 0, $centroX_defensa - 10, $centroY_defensa + 8, $blanco, $fuente, $valorDefensa);

    // Enviar la imagen al navegador
    header('Content-Type: image/jpeg');
    imagejpeg($cartaBase);
    imagedestroy($cartaBase);
?>
