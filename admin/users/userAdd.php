<?php 
    include_once '../../models/UsuarioBD.php';
    
    $usuarioInsertado = null;  // Inicializamos la variable fuera sino no existe fuera 
    $mensaje = "";
    // Comprobar si se ha enviado el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['nickname'])  && !empty($_POST['email']) && !empty($_POST['password'])) {
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password_encriptada = sha1($_POST['password']);

            // Ahora que tomamos todos los valores, insertamos el usuario
            $bd = new UsuarioBD();
            $usuarioInsertado = $bd->insertarUsuario($nickname, $email, $password_encriptada);

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
            
            <form action="" method="POST">
                <label for="nickname">Nickname:</label>
                <input type="text" name="nickname" id="nickname" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit">Añadir Usuario</button>
            </form>

        </div>
        </section>
    </main>
    
<?php include_once '../footer.php'; ?>

