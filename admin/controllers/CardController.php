<?php
    require_once __DIR__ . '../../models/CartaBD.php';
    

    class CardController {
        private $cartaBD;

        public function __construct()
        {
            $this->cartaBD = new CartaBD();
        }

        public function listarCartas() {
            $cartas = $this->cartaBD->obtenerCartas();
            $totalCartas = count($cartas);

            require_once __DIR__ . '../../views/cards/cards.php';
        }

        public function editarCartas() {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
        
                $cartaObtenidaPorId = $this->cartaBD->obtenerCartaPorID($id);
                if (!$cartaObtenidaPorId) {
                    die('Carta no obtenida por ID');
                }
                 // Inicializa variables para el formulario tomando los valores originales de la carta
                $nombre = $cartaObtenidaPorId['nombre'];
                $ataque = $cartaObtenidaPorId['ataque'];
                $defensa = $cartaObtenidaPorId['defensa'];
                $tipo = $cartaObtenidaPorId['tipo'];
                $nombreImagen = $cartaObtenidaPorId['nombreImagen'];
                $poderEspecial = $cartaObtenidaPorId['poderEspecial'];

            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nombre = $_POST['nombre'];
                $ataque = $_POST['ataque'];
                $defensa = $_POST['defensa'];
                $tipo = $_POST['tipo'];
                $nombreImagen = $_POST['nombreImagen'];
                $poderEspecial = $_POST['poderEspecial'];

                $cartas = $this->cartaBD->actualizarCarta($id, $nombre, $ataque, $defensa, $tipo, $nombreImagen, $poderEspecial);
                
                header('Location: /practicas/practicaCartas/index.php?controller=card&action=listarCartas');
            } else {
                require_once __DIR__ . '../../views/cards/cardEdit.php';
            }
        
        }

        public function agregarCartas() {                       
                try {
                    $config = $this->cartaBD->obtenerConfiguracion();
                    $maxDefensa = $config['maxDefensa'];
                    $maxAtaque = $config['maxAtaque'];
                } catch (PDOException $e) {
                    echo "Error: no se pudo obtener la configuración " . $e->getMessage();
                }
            
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Obtener los datos del formulario
                    $nombre = $_POST['nombre'];
                    $ataque = $_POST['ataque'];
                    $defensa = $_POST['defensa'];
                    $tipo = $_POST['tipo'];
                    $nombreImagen = $_POST['nombreImagen'];
                    $poderEspecial = $_POST['poderEspecial'];
            
                    $ruta_carta = null;
                    $directorio_subida = '/Applications/MAMP/htdocs/practicas/practicaCartas/admin/uploads/imagenes/';
            
                    try {
                        // Verificar si los valores de ataque y defensa cumplen los máximos
                        if ($ataque > $maxAtaque || $defensa > $maxDefensa) {
                            $mensaje = "El ataque y/o defensa no puede superar los máximos.";
                        } else {
                            // Procesar la imagen si se ha subido
                            if (!empty($_FILES['url_foto_carta']['name'])) { 
                                $foto_carta = $_FILES['url_foto_carta'];
                                $ruta_carta = $directorio_subida . basename($foto_carta['name']);
                                $tipo_imagen = strtolower(pathinfo($ruta_carta, PATHINFO_EXTENSION)); 
                                $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
                                // Validar tipo y tamaño de la imagen
                                if (in_array($tipo_imagen, $tipos_permitidos) && $foto_carta['size'] < 3000000) {
                                    if (move_uploaded_file($foto_carta['tmp_name'], $ruta_carta)) {
                                    } else {
                                        echo "Hubo un error al subir la imagen.";
                                    }
                                } else {
                                   echo "Formato de imagen no permitido o tamaño demasiado grande.";
                                }
                            }
                            $this->cartaBD->insertarCartas($nombre, $ataque, $defensa, $tipo, $nombreImagen, $poderEspecial, $ruta_carta);
                            echo "Carta agregada correctamente.";
                            
                            // Redirigir a la lista de cartas
                            header("Location: /practicas/practicaCartas/index.php?controller=card&action=listarCartas");
                            exit; 
                        }
            
                    } catch (PDOException $e) {
                       echo "Error: no se pudo agregar la carta. " . $e->getMessage();
                    }
                } else {
                    require_once __DIR__ . '../../views/cards/cardAdd.php';
                }
            }

        public function eliminarCarta() {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $cartaEliminada = $this->cartaBD->eliminarCarta($id);
                header('Location: /practicas/practicaCartas/index.php?controller=card&action=listarCartas');
                exit();
            }
        }

    }
?>