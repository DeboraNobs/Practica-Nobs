<?php 
    require_once '../../models/UsuarioBD.php';

    $db = new UsuarioBD();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $usuarioEliminado = $db->eliminarUsuario($id);
        header('Location: users.php');
    }
?>