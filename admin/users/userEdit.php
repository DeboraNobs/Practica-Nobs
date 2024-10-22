<?php
    require_once '../../models/UsuarioBD.php';

    $bd = new UsuarioBD();

    if (isset($_GET['id'])) {
        $id = $_GET['id']; 

        $usuarioObtenidoPorId = $bd->obtenerUsuarioPorID($id);
        if (!$usuarioObtenidoPorId) { // Verificamos si el usuario existe
            die("Usuario no encontrado.");
        }
         // Inicializa variables para el formulario tomando los valores originales del usuario
        $nickname = $usuarioObtenidoPorId['nickname'];
        $email = $usuarioObtenidoPorId['email'];
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['nickname'])  && !empty($_POST['email']) && !empty($_POST['password'])) {
            $nickname = $_POST['nickname'];
            $email = $_POST['email'];
            $password_encriptada = sha1($_POST['password']);

            $bd->actualizarUsuario($id, $nickname, $email);
            header('Location: users.php'); // Redirigir a la lista de usuarios

        } else {    
            echo "Todos los campos deben completarse";
        }
    }
?>

<?php require_once __DIR__ . '/../header.php'; ?>

    <h1>Editar Usuario</h1>
    <form action="" method="POST">
        <label for="nickname">Nickname:</label>
        <input type="text" name="nickname" id="nickname" value="<?php echo isset($usuarioObtenidoPorId['nickname']) ? $usuarioObtenidoPorId['nickname'] : ''; ?>" >
        
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php  echo isset($usuarioObtenidoPorId['email']) ? $usuarioObtenidoPorId['email'] : ''; ?>" >
        
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password">
        
        <input type="submit" value="Actualizar Usuario">
    </form>

<?php require_once __DIR__ . '/../footer.php'; ?>
