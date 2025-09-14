<?php

require __DIR__ . '/../src/core/Router.php';
require __DIR__ . '/../src/controllers/HomeController.php';

use Src\Core\Router;

$router = new Router();

require __DIR__ . '/../src/routes/Routes.php';

$router->dispatch();

?>