<?php
require __DIR__ . '/../src/core/Router.php';
require __DIR__ . '/../src/controllers/HomeController.php';
require __DIR__ . '/../src/controllers/MaterialController.php';
require __DIR__ . '/../src/controllers/SurgeryController.php';

use Src\Core\Router;

$router = new Router();

require __DIR__ . '/../src/routes/Routes.php';

$router->dispatch();

?>