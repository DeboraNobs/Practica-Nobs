<?php 
    echo "Gracias por elegirnos<br>"; 
    echo "¿Desea volver a ingresar? <br>";
?>

<form method="post" action="">
    <input type="radio" name="respuesta" value="si"> Sí
    <input type="radio" name="respuesta" value="no"> No<br>
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['respuesta'])) {
        $respuesta = $_POST['respuesta'];

        if ($respuesta === 'si') {
            header("Location: login.php"); // Redirige a login.php
            exit();
        } else {
            echo "Gracias. ¡Hasta luego!";
            exit();
        }
    } else {
        echo "Por favor, seleccione una opción.";
    }
}
?>
