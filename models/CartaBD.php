<?php
    require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/config/Conexion.php';

class CartaBD {
    private $conexion;

    public function __construct()
    {
        $db = new Conexion();
        $this->conexion = $db->get_conexion();
    }

    public function obtenerConfiguracion() {
        $config = [];
        $sql = "SELECT clave, valor FROM configuracion WHERE clave IN ('numCartas', 'maxDefensa', 'maxAtaque')";
        
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $config[$row['clave']] = $row['valor'];
        }
        return $config;
    }

    public function obtenerCartas() {
        $cartas = [];
        $sql = 'SELECT * FROM cartas';
        $statement = $this->conexion->prepare($sql);
        $statement->execute();
    
        while ($resultado = $statement->fetch(PDO::FETCH_ASSOC)) {
            $cartas[] = $resultado;
        } 
        return $cartas;
    }

    public function insertarCartas($nombre, $ataque, $defensa, $tipo, $nombreImagen, $poderEspecial, $url_foto_carta) {
        $sqlInsertar = 'INSERT INTO cartas(nombre, ataque, defensa, tipo, nombreImagen, poderEspecial, url_foto_carta) 
                    VALUES(:nombre, :ataque, :defensa, :tipo, :nombreImagen, :poderEspecial, :url_foto_carta)';
        $statement = $this->conexion->prepare($sqlInsertar);
        
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':ataque', $ataque);
        $statement->bindParam(':defensa', $defensa);
        $statement->bindParam(':tipo', $tipo);
        $statement->bindParam(':nombreImagen', $nombreImagen);
        $statement->bindParam(':poderEspecial', $poderEspecial);
        $statement->bindParam(':url_foto_carta', $url_foto_carta);

        if ($statement->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerCartaPorID($id) {
        $sql = "SELECT * FROM cartas WHERE id = :id";
        $statement = $this->conexion->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute();
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCarta($id, $nombre, $ataque, $defensa, $tipo, $nombreImagen, $poderEspecial) {
        $sqlEditar = "UPDATE cartas 
                      SET nombre = :nombre, ataque = :ataque, defensa = :defensa,
                          tipo = :tipo, nombreImagen = :nombreImagen, poderEspecial = :poderEspecial
                      WHERE id = :id";
        $statement = $this->conexion->prepare($sqlEditar);
    
        $statement->bindParam(':id', $id);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':ataque', $ataque);
        $statement->bindParam(':defensa', $defensa);
        $statement->bindParam(':tipo', $tipo);
        $statement->bindParam(':nombreImagen', $nombreImagen);
        $statement->bindParam(':poderEspecial', $poderEspecial);

        return $statement->execute();
    }

    public function eliminarCarta($id) {
        $sql = "DELETE FROM cartas WHERE id = :id";
        $statement = $this->conexion->prepare($sql);
        $statement->bindParam(':id', $id);
        return $statement->execute();
    }
}

?>