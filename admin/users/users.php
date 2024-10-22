<?php
    // require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/models/UsuarioBD.php';
    require_once __DIR__ . '../../../models/UsuarioBD.php';
    require_once __DIR__ . '/../header.php';

    $conexion = (new Conexion())->get_conexion();     // Obtener la conexión

    if ($conexion) { // Si la conexión es exitosa..
        $usuarioBD = new UsuarioBD($conexion);
        $usuarios = $usuarioBD->obtenerUsuarios();
    } else {
        die ("No se pudo conectar a la base de datos.");
    }
?>


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

<?php require_once __DIR__ . '/../footer.php'; ?>
