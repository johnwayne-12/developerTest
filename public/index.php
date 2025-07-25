<?php

header('Content-Type: application/json');

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/ClubeController.php';
require_once __DIR__ . '/../src/RecursoController.php';

$router = new Router($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
$router->route();