<?php include_once __DIR__ . '../../../header.php'; ?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/practicas/practicaCartas/admin/assets/css/admin.css">
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
    
<?php include_once __DIR__ . '../../../footer.php';?>
