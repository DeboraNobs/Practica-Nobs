<?php
    class cartaEspecial extends CartaBase {

        private $poderEspecial;

        public function __construct($nombre, $ataque, $defensa, $poderEspecial = "nadar")
        {
            parent::__construct($nombre, $ataque, $defensa);
            $this->poderEspecial = $poderEspecial;
        }

        public function getNombre() {  return parent::getNombre(); }

        public function getDefensa() { return parent::getDefensa(); }

        public function getAtaque() { return parent::getAtaque(); }

        public function mostrarInfo()
        {
            $info = parent::mostrarInfo();
            return $info .  " Poder especial : " . $this->poderEspecial;
        }

        public function __toString()
        {
            $tostring= parent::__toString();
            return $tostring . " -Poder especial: " . $this->poderEspecial;
        }
    }

?>