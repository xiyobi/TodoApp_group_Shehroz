<?php

use App\Router;

$router = new Router();


if ($router->isApiCall()) {
    require 'routes/api.php';
    exit();
} elseif ($router->isTelegram()) {
    require 'routes/telegram.php';
    exit();
}

require 'routes/web.php';

