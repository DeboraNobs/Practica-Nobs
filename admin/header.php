<?php
    session_start();

    if($_SESSION['user']){
        $username = $_SESSION['user'];
    }else {
        if (isset($_COOKIE['user']) && isset($_COOKIE['logged']) && isset($_COOKIE['logged']) == 1 ) {
            $_SESSION['user'] = $_COOKIE['user'];
            $_SESSION['logged'] = $_COOKIE['logged'];
        }
    }


    if(!$_SESSION['logged']) {   
        header('Location: /practicas/practicaCartas/admin/login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/practicas/practicaCartas/admin/assets/css/admin.css">

</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="/practicas/practicaCartas/admin/dashboard.php">Inicio</a></li>
                <li><a href="/practicas/practicaCartas/admin/users/users.php">Usuarios</a></li>
                <li><a href="/practicas/practicaCartas/admin/cards/cards.php">Cartas</a></li>
                <li><a href="/practicas/practicaCartas/admin/config/configuracion.php">Configuración</a></li>
                <li><a href="/practicas/practicaCartas/admin/login.php?logout=1">Hola <?php echo $username ?> (Cerrar Sesión)</a></li>
            </ul>
        </nav>
    </header>