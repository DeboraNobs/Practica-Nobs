<?php 
    require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/config/Conexion.php';
    // require_once __DIR__ . '/../config/Conexion.php';
class UsuarioBD {
    private $conexion;

    public function __construct() {
        $db = new Conexion();  // Creamos una nueva instancia de la conexión
        $this->conexion = $db->get_conexion(); // Creamos una variable para guardar la conexión a la BBDD
    }

    public function validarLogin($email, $password) {
        $mensajeError = null;
    
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $passwordEncriptada = sha1($password);  // Encriptar la contraseña ingresada con sha1()
    
            $query = "SELECT * FROM usuarios WHERE email = :email AND password = :password";
            $statement = $this->conexion->prepare($query);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $passwordEncriptada);
                            
            if ($statement->execute()) { // si la ejecución es true
                if($statement->rowCount() > 0) { // verificar si devuelve al menos una fila
                    $resultado = $statement->fetch(PDO::FETCH_ASSOC);
                    $contrasenia = $resultado['password'];

                    // Almacenar el email y el nickname en la sesión
                    $_SESSION['email'] = $email; 
                    $_SESSION['user'] = $resultado['nickname'];
                    $_SESSION['password'] = $contrasenia;
                    $_SESSION['logged'] = true;

                    //header("Location: dashboard.php");
                    header("Location: /practicas/practicaCartas/index.php?controller=Dashboard&action=cargarInicio");
                    exit;
                } else {
                    $mensajeError = "Usuario o contraseña incorrectos.";
                    echo $mensajeError;
                }
            } else {
                $mensajeError = "Error al ejecutar la consulta.";
                echo $mensajeError;
            }
        }
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

    public function insertarUsuario($nickname, $email, $password, $foto_perfil = null) {
        $sql = "INSERT INTO usuarios (nickname, email, password, foto_perfil)
                VALUES (:nickname, :email, :password, :foto_perfil)";

        $statement = $this->conexion->prepare($sql); // preparo la consulta para ser ejecutada

        // lo que hace bindParam es => en :nickname pon lo que hay en $nickname...
        $statement->bindParam(':nickname', $nickname);
        $statement->bindParam(':email', $email);
        $statement->bindParam(':password', $password);
        $statement->bindParam(':foto_perfil', $foto_perfil); // nuevo: agrega la url de la foto de perfil

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