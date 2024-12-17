<?php
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $user = (new \App\User())->login($_POST['email'], $_POST['password']);
    if ($user) {
        $save_email = $user['email'];
        $save_password = $user['password'];

        if ($save_email === $_POST['email'] && $save_password === $_POST['password']) {
            unset($_SESSION['error_message']);
            $_SESSION['user_id'] = $user['id'];
            unset($user['password']);
            $_SESSION['user'] = $user;
            redirect('/todos');
        } else {
            $_SESSION['error_message'] = 'Invalid email or password';
            redirect('/login');
        }
    } else {
        $_SESSION['error_message'] = 'Invalid email or password';
        redirect('/login');
    }
} else {
    $_SESSION['error_message'] = 'Please fill in all fields';
    redirect('/login');
}

?>
