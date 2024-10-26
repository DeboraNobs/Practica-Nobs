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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = $_POST['nombre'];
        $ataque = $_POST['ataque'];
        $defensa = $_POST['defensa'];
        $tipo = $_POST['tipo'];
        $nombreImagen = $_POST['nombreImagen'];
        $poderEspecial = $_POST['poderEspecial'];

        
        $ruta_carta = null;
        $directorio_subida = '/Applications/MAMP/htdocs/practicas/practicaCartas/admin/uploads/imagenes/';
    
        try {
            if ($ataque > $maxAtaque || $defensa > $maxDefensa) {
                $mensaje = "El ataque y/o defensa no puede superar los máximos.";
            } else {
                if (!empty($_FILES['url_foto_carta']['name'])) { 
                    $foto_carta = $_FILES['url_foto_carta'];
                    $ruta_carta = $directorio_subida . basename($foto_carta['name']);
                    $tipo_imagen = strtolower(pathinfo($ruta_carta, PATHINFO_EXTENSION)); 
                    $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    
                    if (in_array($tipo_imagen, $tipos_permitidos) && $foto_carta['size'] < 3000000) {
                        if (move_uploaded_file($foto_carta['tmp_name'], $ruta_carta)) {
                            $mensaje = "La imagen se ha subido correctamente.";
                        } else {
                            $mensaje = "Hubo un error al subir la imagen.";
                        }
                    } else {
                        $mensaje = "Formato de imagen no permitido o tamaño demasiado grande.";
                    }
                }
    
                $cartaBD->insertarCartas($nombre, $ataque, $defensa, $tipo, $nombreImagen, $poderEspecial, $ruta_carta);
                $mensaje = "Carta agregada correctamente.";
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

<?php include_once '../header.php'; ?>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Carta</h2>
            <p><?php echo $mensaje; ?></p> <!-- Mostrar el mensaje aquí -->
            
            <form action="" method="POST" enctype="multipart/form-data">
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

<?php include_once '../footer.php'; ?>
