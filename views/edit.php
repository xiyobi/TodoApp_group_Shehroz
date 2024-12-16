<?php
require 'views/components/header.php';
require 'views/components/navbar.php';
?>
<div class="edit-container">
    <h2 class="edit-header">Edit Task</h2>
    <form method="POST" action="/todos/<?= /** @var TYPE_NAME $todo */
    $todo['id'] ?>/update" >
        <input hidden="" type="text" name="_method" value="PUT" id="">
        <div class="form-group">
            <label for="taskName" class="form-label">Task Name</label>
            <input type="text" id="taskName" class="form-control" placeholder="Enter task name" name="title" value="<?= $todo['title'] ?>">
        </div>
        <div class="form-group">
            <label for="taskStatus" class="form-label">Status</label>
            <select id="taskStatus" class="form-select" name="status">
                <option value="pending" <?= $todo['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Completed" <?= $todo['status'] == 'Completed' ? 'selected' : '' ?>>Completed</option>
                <option value="in_progress" <?= $todo['status'] == 'in_progress' ? 'selected' : '' ?>>In Progress</option>
            </select>
        </div>
        <div class="form-group">
            <label for="taskDueDate" class="form-label">Due Date</label>
            <input type="datetime-local" id="taskDueDate" class="form-control" name="due_date" value="<?= $todo['due_date'] ?>">
        </div>
        <div class="btn-actions">
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="/todos" class="btn btn-secondary">Back to Todo list</a>
        </div>
    </form>

</div>
<?php
require 'views/components/footer.php';
?>