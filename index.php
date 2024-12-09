<?php
declare(strict_types=1);
session_start();

function dd($var)
{
    echo "<pre>";
    print_r($var);
    exit;
}

$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$queryString = [];
$query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
if ($query !== null) {
    parse_str($query, $queryString);
}

list($controller, $action) = array_pad(explode('/', $path), 2, 'Index');

$controller = $controller ?: 'Home';
$action = ucfirst($action) ?: 'Index';

$controllerFile = './controllers/' . ucfirst($controller) . "Controller.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $className = ucfirst($controller) . "Controller";

    if (class_exists($className) && method_exists($className, $action)) {
        $instance = new $className();
        $instance->$action($queryString);
    } else {
        die("404");
    }
} else {
    die("404");
}
