<?php
if(!$_SESSION['user']) {
    redirect('/login');

}
$todos = (new \App\Todo())->DeleteUserId($_SESSION['user']['id']);
$user = (new \App\User())->DeleteAccount($_SESSION['user']['id']);
session_destroy();
redirect('/login');



