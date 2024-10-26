<?php
    require_once '../../models/CartaBD.php';

    $conexion = (new Conexion())->get_conexion();

    if ($conexion) {    // si la conexión es exitosa..
        $cartaBD = new CartaBD($conexion);
        $cartas = $cartaBD->obtenerCartas();
        $totalCartas = count($cartas);
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

<?php include_once '../header.php'; ?>

    <h1>Gestión de Cartas</h1>
    <a href="cardAdd.php">Añadir Carta</a>
    <p>Numero de cartas: <?php echo $totalCartas?> </p>
    <table border="2px" style="margin-left: auto; margin-right: auto; width: 80%; border-collapse: collapse;">
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

<?php include_once '../footer.php'; ?>