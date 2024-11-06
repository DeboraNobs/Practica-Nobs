<?php
    require_once __DIR__ . '../../../models/UsuarioBD.php';
    require_once __DIR__ . '../../../header.php';
?>

    <h1>Gestión de Usuarios</h1>
    <a href="/practicas/practicaCartas/index.php?controller=user&action=agregarUsuarios">Añadir Usuario</a>
    
    <table border="2px" style="margin-left: auto; margin-right: auto; width: 80%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nickname</th>
                <th>Email</th>
                <th>Url foto perfil</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['id']; ?></td>
                        <td><?php echo $usuario['nickname']; ?></td>
                        <td><?php echo $usuario['email']; ?></td>
                        <td><?php echo $usuario['foto_perfil']; ?></td>
                        <td>
                            <a href="/practicas/practicaCartas/index.php?controller=user&action=editarUsuarios&id=<?php echo $usuario['id'];?>">Editar</a> |
                            <a href="/practicas/practicaCartas/index.php?controller=user&action=eliminarUsuarios&id=<?php echo $usuario['id']; ?>">Eliminar</a>
                        </td>
                    </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php require_once __DIR__ . '../../../footer.php'; ?>
