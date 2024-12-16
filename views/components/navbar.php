<?php
require 'views/components/header.php';
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; top: 0; width: 100%; z-index:1000;">
    <div class="container">
        <a class="navbar-brand" href="/">Todo App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php
                if (isset($_SESSION['user'])):
                    ?>
                    <li class="dropdown">
                        <a href="/todos" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                                 class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                                <path fill-rule="evenodd"
                                      d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/todos"><?= $_SESSION['user']['full_name'] ?? '' ?></a></li>
                            <li><a class="dropdown-item" href="/todos">To-do List</a></li>
                            <li><a class="dropdown-item"  href="/logout" >log out</a></li>
                            <li><a class="dropdown-item"  href="/DeleteAccount" >Delete Account</a></li>
                        </ul>
                    </li>
                <?php
                else:
                    ?>
                    <li class="nav-item"><a class="nav-link" href="/login">Log in</a></li>
                    <li class="nav-item"><a class="btn btn-primary" href="/register">Register</a></li>
                <?php
                endif;
                ?>
            </ul>
        </div>
    </div>
</nav>