<?php

use App\Todo;

use App\Router;

$router = new Router();

$todo = new Todo();
;
$router->get('/api/todos', function () use ($todo){
    apiResponse($todo->getAllTodos(12));
});

$router->get('/api/todos/{id}', function ($todoId) use ($todo){
    apiResponse($todo->getTodo($todoId));
});

$router->post('/api/todos', function () use ($todo){
    $todo->store($_POST['title'],$_POST['dueDate'], 2);
    apiResponse([
        'ok'=>true,
        'message'=>'update todos successful'
    ]);
});

$router->put('/api/todos/{id}', function ($todoId) use ($todo){
    $todo->update($todoId, $_POST['title'],$_POST['status'], $_POST['dueDate'], 2);
    apiResponse([
        'ok'=>true,
        'message'=>'update todos successful'
    ]);
});


$router->delete('/api/todos/{id}', function ($todoId) use ($todo){
    $todo->destory($todoId);
    apiResponse([
        'ok'=>true,
        'message'=>'delete todos successful'
    ]);
});