<?php 
    // require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/config/Conexion.php';
    require_once __DIR__ . '/../config/Conexion.php';

class UsuarioBD {
    private $conexion;

    public function __construct() {
        $db = new Conexion();  // Creamos una nueva instancia de la conexión
        $this->conexion = $db->get_conexion(); // Creamos una variable para guardar la conexión a la BBDD
    }

    public function obtenerUsuarios() {
        $filas = []; // creamos una variable filas inicializada a null
        $sql= "SELECT * FROM usuarios";
        $statement = $this->conexion->prepare($sql);
        $statement->execute();

        while ($resultado = $statement->fetch(PDO::FETCH_ASSOC)) {  // ahora recorremos los datos obtenidos con un while
            $filas[] = $resultado;
        }
        return $filas;
    }

    public function insertarUsuario($nickname, $email, $password) {
        $sql = "INSERT INTO usuarios (nickname, email, password)
                VALUES (:nickname, :email, :password)";

        $statement = $this->conexion->prepare($sql); // preparo la consulta para ser ejecutada

        // lo que hace bindParam es => en :nickname pon lo que hay en $nickname...
        $statement->bindParam(':nickname', $nickname);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);

        if($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Método para obtener un usuario por su ID
    public function obtenerUsuarioPorID($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Recupera toda la información asociada a ese ID y la devuelve como un array asociativo.
    }

    public function actualizarUsuario($id, $nickname, $email) {
        $sql = "UPDATE usuarios SET nickname = :nickname, email = :email WHERE id = :id";
        $statement = $this->conexion->prepare($sql);
        $statement->bindParam(':nickname', $nickname);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':id', $id);
        return $statement->execute(); // Retorna true si la actualización fue exitosa
    }

    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $statement = $this->conexion->prepare($sql);
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }

}
?>