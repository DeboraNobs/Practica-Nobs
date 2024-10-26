<?php 
    include_once '../../models/UsuarioBD.php';
    
    $usuarioInsertado = null; 
    $mensaje = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {   // comprueba si se ha enviado el formulario
        if (!empty($_POST['nickname'])  && !empty($_POST['email']) && !empty($_POST['password'])) {
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password_encriptada = sha1($_POST['password']);

            $ruta_imagen = null;
            $directorio_subida = '/Applications/MAMP/htdocs/practicas/practicaCartas/admin/uploads/imagenes/';

            if (!is_dir($directorio_subida)) { // verifica si el directorio no existe
                mkdir($directorio_subida, 0777, true); // si no existe lo crea, con permisos 777
            }

            if (!empty($_FILES['foto-perfil']['name'])) { // procesa la imagen si el $_FILES del input name =
                $foto_perfil = $_FILES['foto-perfil'];
                $ruta_imagen = $directorio_subida . basename($foto_perfil['name']);
                
                // validacion de tipo y tamaño de la imagen permitidos
                $tipo_imagen = strtolower(pathinfo($ruta_imagen, PATHINFO_EXTENSION)); 
                $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (in_array($tipo_imagen, $tipos_permitidos) && $foto_perfil['size'] < 3000000) { // si en el array todo da TRUE
                    if (move_uploaded_file($foto_perfil['tmp_name'], $ruta_imagen)) {
                        if (is_file($ruta_imagen)) {
                            $mensaje = "La imagen de perfil se ha subido correctamente.";
                        }
                    } else {
                        $mensaje = "Hubo un error al subir la imagen de perfil.";
                        $ruta_imagen = null;
                    }
                } else {
                    $mensaje = "Formato de imagen no permitido o tamaño demasiado grande.";
                }
            }

            // tomamos todos los valore del usuario, e insertamos el usuario a la bbdd
            $bd = new UsuarioBD();
            $usuarioInsertado = $bd->insertarUsuario($nickname, $email, $password_encriptada, $ruta_imagen); // ruta imagen inserta SOLO LA URL de la img para no cargarla en la bbdd

            if ($usuarioInsertado) {
                $mensaje = "Usuario insertado correctamente";
            } else {
                $mensaje = "Hubo un error al insertar el usuario";
            }

        } else {
            $mensaje = "Por favor, completa todos los campos.";
        }
    }
?>

<?php include_once '../header.php'; ?>
    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Usuario</h2>
            <p><?php echo $mensaje; ?></p>
            
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nickname">Nickname:</label>
                <input type="text" name="nickname" id="nickname" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>

                <label for="foto-perfil">Foto de perfil: (Opcional)</label>
                <input type="file" name="foto-perfil" id="foto-perfil">

                <button type="submit">Añadir Usuario</button>
            </form>

        </div>
        </section>
    </main>
    
<?php include_once '../footer.php'; ?>

