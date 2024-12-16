<?php
/**@var $todoId \App\Todo */
$getTodo = (new \App\Todo())->getTodo($todoId);
view('edit',[
    'todo'=>$getTodo
]);
