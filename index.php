<?php
// index.php (Front Controller / Router)

// Tentukan controller default
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'lecturer';
// Tentukan action default
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Buat nama file controller
$controllerFile = 'controllers/' . ucfirst($controller) . 'Controller.php';

if (file_exists($controllerFile)) {
    require_once $controllerFile;

    // Buat nama class controller
    $controllerClass = ucfirst($controller) . 'Controller';
    $controllerInstance = new $controllerClass();

    // Cek apakah method (action) ada di dalam class
    if (method_exists($controllerInstance, $action)) {
        // Panggil method
        $controllerInstance->$action();
    } else {
        echo "Action not found!";
    }
} else {
    echo "Controller not found!";
}
?>