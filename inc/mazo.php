 <?php
    include './inc/juego.php';

    class Mazo {
        private $arrayCartas = []; 

        public function __construct(Juego $juego) {
            $this->generarCartasAleatorias($juego);
        }

        public function generarCartasAleatorias(Juego $juego) {
            $this->arrayCartas = $juego->generarCartasAleatorias();
        }

        public function sacarCarta() {
            if (count($this->arrayCartas) > 0) {
                $carta = array_shift($this->arrayCartas); 
                return $carta; 
            } else {
                return null;
            }
        }        

        public function cartasRestantes() {
            return count($this->arrayCartas);
        }
    }

    ?>


