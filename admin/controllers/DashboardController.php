<?php
    require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/admin/models/CartaBD.php';
    require_once '/Applications/MAMP/htdocs/practicas/practicaCartas/admin/models/UsuarioBD.php';

    class DashboardController {
        private $cartaBD;
        private $usuarioBD;

        public function __construct()
        {
            $this->cartaBD = new CartaBD();
            $this->usuarioBD = new UsuarioBD();
        }

        public function cargarInicio() {
            $cartas = $this->cartaBD->obtenerCartas(); 
            $totalCartas = count($cartas); 
        
            $usuarios = $this->usuarioBD->obtenerUsuarios();
            $totalUsuarios = count($usuarios);
        
            $configuracion = $this->cartaBD->obtenerConfiguracion();
            $num_cartas = $configuracion['numCartas'];
            $max_defensa = $configuracion['maxDefensa'];
            $max_ataque = $configuracion['maxAtaque'];

            require_once __DIR__ . '/../dashboard.php';
        } 
        
    }
?>