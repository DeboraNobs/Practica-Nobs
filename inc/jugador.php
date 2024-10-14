<?php
    include './inc/mazo.php';

    class Jugador {
        private $nombre;
        private $mazo;

        public function __construct($nombre, Juego $juego)
        {
            $this->nombre = $nombre;
            $this->mazo = new Mazo($juego); // El constructor de Mazo necesita un objeto de Juego
        }
        
        public function getNombre() {
            return $this->nombre;
        }

        public function jugarCarta() {
            if ($this->tieneCartas()) {
                return $this->mazo->sacarCarta();
            } else {
                echo "No quedan cartas";
                return null; 
            }
        }
        
        public function tieneCartas() {
            if ($this->mazo->cartasRestantes() > 0) {
                return true;
            } else {
                return false;
            }
        }

        public function mostrarMazo() {
            echo "Mazo del jugador: " . print_r($this->mazo) . "<br>";
        }

        public function cartasRestantes() {
            return $this->mazo->cartasRestantes();
        }
    }
?>