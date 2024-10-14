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
    $conexion = (new Conexion())->get_conexion();  // Obtener la conexión

    $mensajeError = null;

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $usuario = $_POST['username'];
        $password = $_POST['password'];

        $passwordEncriptada = sha1($password);

        $query = "SELECT * FROM usuarios WHERE nickname = :nickname AND password = :password";
        $statement = $conexion->prepare($query);
        $statement->bindParam(':nickname', $usuario);
        $statement->bindParam(':password', $passwordEncriptada);
        
        if ($statement->execute()) { // si la ejecución es true
            if ($statement->rowCount() > 0) { // y si devuelve al menos una fila me redirige a dashboard.php
                header("Location: dashboard.php");
                exit;
            } else {
                $mensajeError = "Usuario o contraseña incorrectos.";
                echo $mensajeError;
            }
        } else {
            $mensajeError = "Error al ejecutar la consulta.";
            echo $mensajeError;
        }
    }
?>
    <div class="login-container">
        <form action="" method="POST" class="login-form">
            <h2>Iniciar Sesión</h2>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
