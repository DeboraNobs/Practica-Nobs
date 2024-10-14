<?php
    include './inc/cartaBase.php';

    class Juego {
        private $numCartas;
        private $maxAtaque;
        private $maxDefensa;

        public function __construct($numCartas, $maxAtaque, $maxDefensa)
        {
            $this->numCartas = $numCartas;
            $this->maxAtaque = $maxAtaque;
            $this->maxDefensa = $maxDefensa;
        }

        public function getNumCartas() {
            return $this->numCartas;
        }

        public function getMaxAtaque() {
            return $this->maxAtaque;
        }

        public function getMaxDefensa() {
            return $this->maxDefensa;
        }

        public function generarCartasAleatorias() {
            $listaNombres = "Guardián, Místico, Sombra, Mago de Hielo, Elemental de Fuego, 
            Cazador de Tormentas, Caballero Dragón, Oráculo, Bardo, Encantador, Domador, 
            Caballero Sombrío, Mago Rúnico, Acechador Nocturno, Hechicero Celestial, Guerrero Fénix, 
            Ranger, Druida, Vampiro, Hechicero, Bruja, Gladiador, Monje, Alquimista, Valquiria, 
            Ilusionista, Maestro de Bestias, Cambiante, Elementalista, Nigromante";

            $nombresCartas = explode(", ", $listaNombres);
            $arrayCartas = [];

            for ($i = 0; $i < $this->numCartas; $i++) {
                
                $nombre = $nombresCartas[array_rand($nombresCartas)]; 
                $ataque = rand(1, $this->getMaxAtaque());  
                $defensa = rand(1, $this->getMaxDefensa()); 

                $arrayCartas[] = new cartaBase($nombre, $ataque, $defensa);
            }
            return $arrayCartas;
        }
    }
?>