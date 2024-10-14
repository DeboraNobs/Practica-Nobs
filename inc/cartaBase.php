<?php
    include './inc/carta.php';
    class CartaBase implements Carta {
        private $nombre;
        private $ataque;
        private $defensa;

        public function __construct($nombre, $ataque, $defensa)
        {
            $this->nombre = $nombre;
            $this->ataque = $ataque;
            $this->defensa = $defensa;
        }

        public function getNombre() {  return $this->nombre; }

        public function getDefensa() { return $this->defensa; }

        public function getAtaque() { return $this->ataque; }

        public function mostrarInfo() { return "<u> Info: </u> " . " -Nombre:" . $this->nombre . " -Defensa: " . $this->defensa . " -Ataque: " . $this->ataque . " "; }

        public function __toString() { return "<u> Info: </u> " . " -Nombre:" . $this->nombre . " -Defensa: " . $this->defensa . " -Ataque: " . $this->ataque . " "; }

    }
    
?>