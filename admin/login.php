<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/admin.css">
</head>
<body>

<?php 
    require_once '../models/UsuarioBD.php'; 
    session_start();
    $usuarioBD = new UsuarioBD();

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['entrar'])) { // si llega por post y ha clickado en el botón entrar

        if (!empty($_POST['email']) && !empty($_POST['password'])) { // si se ha completado el email y el password
            $email = $_POST['email'];                         // toma los datos $email y $password que ha puesto el cliente
            $password = $_POST['password'];

            $usuarioBD->validarLogin($email, $password);        // uso $email y $password para validar si existe el usuario en la BBDD
   
            if (isset($_POST['recordar'])) {                   // si el cliente le da al checkbox "recordar" creará dos coockies, (user y logged)
                setcookie('user', $email, time() + (86400 * 30), "/");  // guarda el user con el => email
                setcookie('logged', true, time() + (86400 * 30), "/");  
            } 
        }
    }

    if (isset($_GET['logout']) == 1) {   // si se hace logout se borran las variables de sesión y logged se hace false.
        $_SESSION['user'] = ""; 
        $_SESSION['logged'] = false;
        $_SESSION['email'] = "";

        setcookie('user', '', time() - 3600, "/");   // y se setean la cookie 'user' a vacía.
        setcookie('logged', false, time() - 3600, "/");  // se setea la cookie 'logged' a false.

        session_unset();   // vacío las variables de sesión
        session_destroy(); // destruyo las variables de sesión para que no existan más en memoria
        header("Location: login.php"); 
        exit;
    }

    echo "<pre>Variables de sesión actuales: ";
    print_r($_SESSION);
    echo "</pre>";
?>
    <div class="login-container">
        <form action="" method="POST" class="login-form">
            <h2>Iniciar Sesión</h2>
            <label for="email">Usuario:</label>
            <input type="text" id="email" name="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            
            <label for="recordar"> Recordar mi sesión </label>      
            <input type="checkbox" name="recordar">

            <button name="entrar" type="submit">Entrar</button>
        </form>
    </div>
    
    </body>
</html>

