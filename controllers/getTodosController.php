<?php
if(!$_SESSION['user']) {
    redirect('/login');
}
$todos = (new \App\Todo())->getAllTodos($_SESSION['user']['id']);
view('todos',[
    'todos'=>$todos
]);



