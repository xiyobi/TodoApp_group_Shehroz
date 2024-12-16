<?php
/** @var TYPE_NAME $todoId */
(new \App\Todo())->destroy($todoId);
redirect('/todos');