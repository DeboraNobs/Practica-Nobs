<?php
    session_start(); // hago aqui un session start();
    
    // Configura controlador y acción predeterminados
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'Dashboard'; //dashboardController.php (defecto)
    $action = isset($_GET['action']) ? $_GET['action'] : 'cargarInicio'; // count de total cartas (todo lo del dashboard.php)

    // Construye el nombre del archivo y de la clase del controlador
    $controllerFile = "admin/controllers/" . ucfirst($controller) . "Controller.php";
    $controllerClass = ucfirst($controller) . "Controller";

    if (file_exists($controllerFile)) {  // Verifica si el archivo del controlador existe
        require_once $controllerFile; // Cargo el Archivo necesario
        
        if (class_exists($controllerClass)) {  // Verifica si la clase del controlador existe
            $controllerObject = new $controllerClass(); // Crea una instancia del controlador
    
            if (method_exists($controllerObject, $action)) {  // Verifica si el método (acción) existe en el controlador
                $controllerObject->$action(); // Ejecuta la acción
            } else {
                echo "Error: Acción '$action' no encontrada en el controlador '$controllerClass'.";
            }
        } else {
            echo "Error: Clase de controlador '$controllerClass' no encontrada.";
        }

    } else {
        echo "Error: Archivo de controlador '$controllerFile' no encontrado.";
    }
    
?>