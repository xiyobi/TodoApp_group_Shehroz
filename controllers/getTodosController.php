<?php
$todos = (new \App\Todo())->getAllTodos();
view('todos',[
    'todos'=>$todos
]);
