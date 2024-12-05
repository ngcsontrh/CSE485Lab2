<?php

function dd($var)
{
    echo "<pre>";
    print_r($var);
    exit;
}

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

list($controller, $action) = array_pad(explode('/', $path), 2, 'Index');

$controller = $controller ?: 'Home';
$action = ucfirst($action) ?: 'Index';

$controllerFile = './controllers/' . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($controller) . "Controller";

    if (class_exists($className) && method_exists($className, $action)) {
        $instance = new $className();
        $instance->$action();
    } else {
        http_response_code(404);
        echo "Action not found!";
    }
} else {
    http_response_code(404);
    echo "Controller not found!";
}
