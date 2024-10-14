<?php
    // require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/models/UsuarioBD.php';
    require_once __DIR__ . '../../../models/UsuarioBD.php';

    $conexion = (new Conexion())->get_conexion();     // Obtener la conexión

    if ($conexion) { // Si la conexión es exitosa..
        $usuarioBD = new UsuarioBD($conexion);
        $usuarios = $usuarioBD->obtenerUsuarios();
    } else {
        die ("No se pudo conectar a la base de datos.");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
            <li><a href="../dashboard.php">Inicio</a></li>
                <li><a href="users.php">Usuarios</a></li>
                <li><a href="../cards/cards.php">Cartas</a></li>
                <li><a href="../config/configuracion.php">Configuración</a></li>
                <li><a href="../logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <h1>Gestión de Usuarios</h1>
    <a href="userAdd.php">Añadir Usuario</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nickname']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td>
                        <a href="userEdit.php?id=<?php echo $usuario['id']; ?>">Editar</a> |
                        <a href="userDelete.php?id=<?php echo $usuario['id']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
