<?php
    require_once '../../models/CartaBD.php';

    $conexion = (new Conexion())->get_conexion();

    if ($conexion) { // Si la conexión es exitosa..
        $cartaBD = new CartaBD($conexion);
        $cartas = $cartaBD->obtenerCartas();
    } else {
        die ("No se pudo conectar a la base de datos.");
    }

    // para eliminar cartas
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $cartaEliminada = $cartaBD->eliminarCarta($id);
        header('Location: cards.php');
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Cartas</title>
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
    <h1>Gestión de Cartas</h1>
    <a href="cardAdd.php">Añadir Carta</a>
    <p>Numero de cartas: </p>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Ataque</th>
                <th>Defensa</th>
                <th>Tipo</th>
                <th>Nombre de imagen</th>
                <th>Poder Especial</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartas as $carta): ?>
                <tr>
                    <td><?php echo $carta['nombre']; ?></td>
                    <td><?php echo $carta['ataque']; ?></td>
                    <td><?php echo $carta['defensa']; ?></td>
                    <td><?php echo $carta['tipo']; ?></td>
                    <td><?php echo $carta['nombreImagen']; ?></td>
                    <td><?php echo $carta['poderEspecial']; ?></td>
                    <td>
                        <a href="cardEdit.php?id=<?php echo $carta['id']; ?>">Editar</a> |
                        <a href="cards.php?id=<?php echo $carta['id']; ?>">Eliminar</a> |
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>