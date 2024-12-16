<?php
/** @var TYPE_NAME $todoId */
$getTodo = (new \App\Todo())->getTodo($todoId);
view('edit', [
    'todo'=>$getTodo
]);