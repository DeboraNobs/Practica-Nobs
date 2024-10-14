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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
            <li><a href="../dashboard.php">Inicio</a></li>
                <li><a href="users.php">Usuarios</a></li>
                <li><a href="./cards/cards.php">Cartas</a></li>
                <li><a href="../config/configuracion.php">Configuración</a></li>
                <li><a href="../logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Usuario</h2>
            <p><?php echo $mensaje; ?></p> <!-- Mostrar el mensaje aquí -->
            
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
</body>
</html>
