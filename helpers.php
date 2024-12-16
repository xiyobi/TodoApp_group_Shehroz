<?php
function view($page, $data = [])
{
    extract($data);
    require 'views/'.$page. '.php';
}
function redirect(string $url){
    header("Location: $url");
}