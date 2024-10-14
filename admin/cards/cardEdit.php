<?php
    require_once '../../models/CartaBD.php';

    $bd = new CartaBD();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $cartaObtenidaPorId = $bd->obtenerCartaPorID($id);
        if (!$cartaObtenidaPorId) {
            die('Carta no obtenida por ID');
        }
         // Inicializa variables para el formulario tomando los valores originales de la carta
        $nombre = $cartaObtenidaPorId['nombre'];
        $ataque = $cartaObtenidaPorId['ataque'];
        $defensa = $cartaObtenidaPorId['defensa'];
        $tipo = $cartaObtenidaPorId['tipo'];
        $nombreImagen = $cartaObtenidaPorId['nombreImagen'];
        $poderEspecial = $cartaObtenidaPorId['poderEspecial'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(!empty($_POST['nombre']) && !empty($_POST['ataque']) && !empty($_POST['defensa']) && !empty($_POST['tipo']) 
                && !empty($_POST['nombreImagen']) && !empty($_POST['poderEspecial'])) {
                    $nombre = $_POST['nombre'];
                    $ataque = $_POST['ataque'];
                    $defensa = $_POST['defensa'];
                    $tipo = $_POST['tipo'];
                    $nombreImagen = $_POST['nombreImagen'];
                    $poderEspecial = $_POST['poderEspecial'];

                    $bd->actualizarCarta($id, $nombre, $ataque, $defensa, $tipo, $nombreImagen, $poderEspecial);
                    header('Location: cards.php');
            } else {    
                echo "Todos los campos deben completarse";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Carta</title>
</head>
<body>
    <h1>Editar Carta</h1>
    <form action="" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo isset($cartaObtenidaPorId['nombre']) ? $cartaObtenidaPorId['nombre'] : ''; ?>" >
        
        <label for="ataque">Ataque:</label>
        <input type="text" name="ataque" id="ataque" value="<?php  echo isset($cartaObtenidaPorId['ataque']) ? $cartaObtenidaPorId['ataque'] : ''; ?>" >
        
        <label for="defensa">Defensa:</label>
        <input type="text" name="defensa" id="defensa" value="<?php  echo isset($cartaObtenidaPorId['defensa']) ? $cartaObtenidaPorId['defensa'] : ''; ?>">
        
        <label for="tipo">Tipo:</label>
        <input type="text" name="tipo" id="tipo" value="<?php  echo isset($cartaObtenidaPorId['tipo']) ? $cartaObtenidaPorId['tipo'] : ''; ?>">

        <label for="nombreImagen">Nombre Imagen:</label>
        <input type="text" name="nombreImagen" id="nombreImagen" value="<?php  echo isset($cartaObtenidaPorId['nombreImagen']) ? $cartaObtenidaPorId['nombreImagen'] : ''; ?>">
        
        <label for="poderEspecial">Poder Especial:</label>
        <input type="text" name="poderEspecial" id="poderEspecial" value="<?php  echo isset($cartaObtenidaPorId['poderEspecial']) ? $cartaObtenidaPorId['poderEspecial'] : ''; ?>">

        <input type="submit" value="Actualizar Carta">
    </form>
</body>
</html>