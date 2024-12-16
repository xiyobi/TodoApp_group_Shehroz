<?php

use JetBrains\PhpStorm\NoReturn;

function view($page, $data = [])
{
    extract($data);
    require 'views/'.$page. '.php';
}
function redirect(string $url){
    header("Location: $url");
    exit();
}

#[NoReturn] function apiResponse($data): void
{
    header("Content-Type: application/json");
    echo json_encode($data);
    exit();
}
