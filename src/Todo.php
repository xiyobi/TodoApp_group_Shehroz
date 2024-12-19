<?php

namespace App;

use App\DB;
use PDO;

class Todo
{
    public $pdo;
    public function __construct(){
        $db = new DB();
        $this->pdo = $db->conn;

    }
    public function store (string $title, string $dueDate, int $userId) {
        $query = "INSERT INTO todos(title, status, due_date, created_at, updated_at, user_id) VALUES (:title, 'pending', :due_date, NOW(), NOW(), :user_id)";
        $this->pdo->prepare($query)->execute([
        ":title" => $title,
        ":due_date" => $dueDate,
        ":user_id" => $userId
    ]);
}
    public function update (int $id, string $title, string $status, string $dueDate) {
        $query = "UPDATE todos set title=:title,status=:status, due_date=:due_date, updated_at=NOW() where id=:id";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ":id" => $id,
            ":title" => $title,
            ":status" => $status,
            ":due_date" => $dueDate
        ]);
    }
    public function updatestatus (int $id, string $status) {
        $query = "UPDATE todos set status=:status, updated_at=NOW() where id=:id";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ":id" => $id,
            ":status" => $status,
        ]);
    }

public function getAllTodos (int $userId) {
        $query="SELECT * from todos WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ":user_id" => $userId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function destory (int $id){
    $query = "Delete from todos where id = :id";
    return $this->pdo->prepare($query)->execute([
        ":id" => $id
    ]);
}
public function getTodo (int $id){
    $query = "Select * from todos where id = :id";
    $stmt = $this->pdo->prepare($query);
    $stmt->execute([
        ":id" => $id
    ]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function DeleteUserId(int $userId)
    {
        $query = "DELETE FROM todos WHERE user_id = :id";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ":id" => $userId
        ]);

}

    public function getAllTodosByTelegramId(int $telegramId): array
    {
        $query = "SELECT todos.title, todos.status, todos.due_date, todos.id as task_id FROM todos INNER JOIN todoapp.users users ON  todos.user_id = users.id WHERE users.telegram_id = :telegramId";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ":telegramId" => $telegramId,
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}
