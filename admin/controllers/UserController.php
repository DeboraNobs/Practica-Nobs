<?php
    require_once __DIR__ . '../../models/UsuarioBD.php';

    class UserController {
        private $usuarioBD;

        public function __construct()
        {
            $this->usuarioBD = new UsuarioBD();
        }

        public function listarUsuarios() {
            $usuarios = $this->usuarioBD->obtenerUsuarios();
            require_once __DIR__ . '../../views/users/users.php';
        }

        public function editarUsuarios() {
            if (isset($_GET['id'])) {
                $id = $_GET['id']; 
        
                $usuarioObtenidoPorId = $this->usuarioBD->obtenerUsuarioPorID($id);
                if (!$usuarioObtenidoPorId) { 
                    die("Usuario no encontrado.");
                }
                $nickname = $usuarioObtenidoPorId['nickname'];
                $email = $usuarioObtenidoPorId['email'];
            }
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['nickname'])  && !empty($_POST['email']) && !empty($_POST['password'])) {
                    $nickname = $_POST['nickname'];
                    $email = $_POST['email'];
                    $password_encriptada = sha1($_POST['password']);
        
                    $this->usuarioBD->actualizarUsuario($id, $nickname, $email);
                    header('Location: /practicas/practicaCartas/index.php?controller=user&action=listarUsuarios');
                    exit();

                } else {
                    echo "Todos los campos deben completarse";
                }
            }

            require_once __DIR__ . '../../views/users/userEdit.php';
        }

            public function agregarUsuarios() {
                $usuarioInsertado = null;
            
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (!empty($_POST['nickname']) && !empty($_POST['email']) && !empty($_POST['password'])) {
                        $nickname = $_POST['nickname'];
                        $email = $_POST['email'];
                        $password_encriptada = sha1($_POST['password']); 
            
                        $ruta_imagen = null;
                        $directorio_subida = '/Applications/MAMP/htdocs/practicas/practicaCartas/admin/uploads/imagenes/';
            
                        if (!is_dir($directorio_subida)) {
                            mkdir($directorio_subida, 0777, true);
                        }
            
                        if (!empty($_FILES['foto-perfil']['name'])) {
                            $foto_perfil = $_FILES['foto-perfil'];
                            $ruta_imagen = $directorio_subida . basename($foto_perfil['name']);
                            
                            $tipo_imagen = strtolower(pathinfo($ruta_imagen, PATHINFO_EXTENSION)); 
                            $tipos_permitidos = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
                            if (in_array($tipo_imagen, $tipos_permitidos) && $foto_perfil['size'] < 3000000) {
                                if (move_uploaded_file($foto_perfil['tmp_name'], $ruta_imagen)) {
                                    echo "La imagen de perfil se ha subido correctamente.";
                                } else {
                                    echo "Hubo un error al subir la imagen de perfil.";
                                    $ruta_imagen = null;
                                }
                            } else {
                                echo "Formato de imagen no permitido o tamaño demasiado grande.";
                                $ruta_imagen = null;
                            }
                        }
                        $usuarioInsertado = $this->usuarioBD->insertarUsuario($nickname, $email, $password_encriptada, $ruta_imagen);
            
                        if ($usuarioInsertado) {
                            header("Location: /practicas/practicaCartas/index.php?controller=user&action=listarUsuarios");
                            include '/Applications/MAMP/htdocs/practicas/practicaCartas/mail/registro.php';
                            exit;
                        } else {
                            echo "Hubo un error al insertar el usuario";
                        }
                    } else {
                        echo "Los campos de nickname, email y password son obligatorios.";
                    }
                } else {
                    require_once __DIR__ . '../../views/users/userAdd.php';
                }
        } 

        public function eliminarUsuarios() {
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $usuarioEliminado = $this->usuarioBD->eliminarUsuario($id);

                if ($usuarioEliminado) {
                    header('Location: /practicas/practicaCartas/index.php?controller=user&action=listarUsuarios');
                    exit();           
                } else {
                    echo "Error al eliminar el usuario";
                }
            }
        }


    }


?>
