<?php
require 'views/components/header.php';
require 'views/components/navbar.php';

?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="todo-body my-5 p-3">
            <h1 class="text-center todo-text">Todo App</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam ipsa non quo totam! Culpa dicta ex in
                laborum praesentium, veritatis!</p>
            <form method="POST" action="/todos">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username"
                           aria-label="Recipient's username" aria-describedby="button-addon2"
                           name="title" required>
                    <input type="datetime-local" class="form-control" placeholder="Recipient's username"
                           aria-label="Recipient's username" aria-describedby="button-addon2"
                           name="due_date" required>
                    <button class="btn btn-primary" type="submit" id="button-addon2">Add</button>
                </div>
            </form>
            <ul class="list-group">
                <?php
                /** @var TYPE_NAME $todos */
                foreach ($todos as $todo) {

                    echo '
                       <li class="' . $todo['status'] . '  list-group-item d-flex justify-content-between align-items-center">  
                      ' . $todo['title'] . '
                      <div>
                     <a href ="/todos/' . $todo["id"] . '/update" class="btn btn-outline-success">Edit</ahref>
                     <a href ="/todos/' . $todo["id"] . '/delete" class="btn btn-outline-success">Delete</a>
                     </div>
                     </li>
                    ';
                }

               ?>

            </ul>
        </div>
    </div>
</div>
<?php
require 'views/components/footer.php';
?>

