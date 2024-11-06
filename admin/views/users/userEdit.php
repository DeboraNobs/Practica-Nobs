<?php require_once __DIR__ . '../../../header.php'; ?>

    <h1>Editar Usuario</h1>
    <form action="/practicas/practicaCartas/index.php?controller=user&action=editarUsuarios&id=<?php echo $id; ?>" method="POST">

    <form action="" method="POST">
        <label for="nickname">Nickname:</label>
        <input type="text" name="nickname" id="nickname" value="<?php echo isset($usuarioObtenidoPorId['nickname']) ? $usuarioObtenidoPorId['nickname'] : ''; ?>" >
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php  echo isset($usuarioObtenidoPorId['email']) ? $usuarioObtenidoPorId['email'] : ''; ?>" >
        
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        
        <input type="submit" value="Actualizar Usuario">
    </form>

<?php require_once __DIR__ . '../../../footer.php'; ?>
