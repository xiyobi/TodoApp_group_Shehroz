<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'bootstrap.php';
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

use App\Todo;
use App\Router;

require 'helpers.php';

$router = new Router();
$todo= new Todo();

$router->get('/',fn()=>require 'controllers/homeController.php');

$router->put("/todos/{id}/update",fn($todoId)=>require 'controllers/updateTodosController.php');

$router->get('/todos/{id}/update',fn($todoId)=>require 'controllers/editTodoController.php');


$router->get('/todos',fn()=>require 'controllers/getTodosController.php');


$router->post('/todos',fn()=>require 'controllers/postTodosController.php');


$router->get('/todos/{id}/delete', function($todoId) use($todo){
    $todo->destory($todoId);
    redirect('/todos');
});


































