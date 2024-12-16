<?php
/**@var $todoId \App\Todo */
$todo=(new \App\Todo())->destory($todoId);
redirect('/todos');
