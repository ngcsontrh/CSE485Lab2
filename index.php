<?php

$routes = require './route.php';

$requestUri = $_SERVER['REQUEST_URI'];

require $routes[$requestUri];