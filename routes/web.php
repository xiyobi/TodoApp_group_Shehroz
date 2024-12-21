<?php

namespace App;

use App\Todo;
use App\Router;

$router = new Router();

$router->get('/register', fn() => view('register'));
$router->post('/register', fn() => require 'controllers/storeUserController.php');

$router->get('/login', fn() => view('login'));
$router->post('/login', fn() => require 'controllers/loginUsersController.php');

$router->get('/DeleteAccount', fn() => view('DeleteAccount'));
$router->post('/deleteAccount', fn() => require 'controllers/deleteUserController.php');

$router->get('/', fn() => require 'controllers/homeController.php');
$router->get('/logout', fn() => require 'controllers/logoutController.php');

$router->put('/todos/{id}/update', fn($todoId) => require 'controllers/updateTodosController.php');
$router->get('/todos/{id}/update', fn($todoId) => require 'controllers/editTodoController.php');

$router->get('/todos', fn() => require 'controllers/getTodosController.php');
$router->post('/todos', fn() => require 'controllers/storeTodosController.php');

$router->get('/todos/{id}/delete', fn($todoId) => require 'controllers/showDeleteTodoController.php');
$router->post('/todos/{id}/delete', fn($todoId) => require 'controllers/deleteTodosController.php');
