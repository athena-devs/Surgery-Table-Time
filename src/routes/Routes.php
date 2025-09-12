<?php

use Src\Controllers\HomeController;

include("../core/Router.php");

$router->add('GET', '/', [HomeController::class]);

?>