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

<?php include_once __DIR__ . '../../../header.php'; ?>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Carta</h2>
            
            <form action="/practicas/practicaCartas/index.php?controller=card&action=agregarCartas" method="post" enctype="multipart/form-data">

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

                <label for="urlFotoCarta"> Foto de la carta: (Opcional)</label>
                <input type="file" name="url_foto_carta" id="url_foto_carta">

                <button type="submit">Añadir Carta</button>
            </form>

        </div>
        </section>
    </main>

<?php include_once __DIR__ . '../../../footer.php'; ?>
