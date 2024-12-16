<?php
if (!empty($_POST['title']) && !empty($_POST['due_date'])) {
    (new \App\Todo())->store($_POST['title'], $_POST['due_date']);
    redirect('/todos');
}