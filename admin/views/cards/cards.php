<?php
    require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/admin/models/CartaBD.php';
    include_once __DIR__ . '../../../header.php';
?>

    <h1>Gestión de Cartas</h1>
    <a href="/practicas/practicaCartas/index.php?controller=card&action=agregarCartas">Añadir Carta</a>
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
                        <a href="/practicas/practicaCartas/index.php?controller=card&action=editarCartas&id=<?php echo $carta['id'];?>">Editar</a> |
                        <a href="/practicas/practicaCartas/index.php?controller=card&action=eliminarCarta&id=<?php echo $carta['id']; ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

<?php include_once __DIR__ . '../../../footer.php'; ?>