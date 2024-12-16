<?php
$todo = (new \App\Todo());
if (!empty(isset($_POST['title'])) and !empty(isset($_POST['due_date']))) {
    $todo->store($_POST['title'], $_POST['due_date'],$_SESSION['user']['id']);
    redirect('/todos');
}
