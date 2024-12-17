<?php

use App\Router;

$router = new Router();

if($router->isApiCall()){
    require 'routes/api.php';
    exit();
}

if($router->isTelegramm()){
    require 'routes/telegram.php';
}

require 'routes/web.php';