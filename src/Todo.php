<?php

namespace App;

use App\DB;

use PDO;

class Todo
{
    public $pdo;

    public function __construct()
    {
        $db = new DB();
        $this->pdo = $db->conn;
    }

    public function store(string $title, string $dueDate): void
    {
        $query = "INSERT INTO todos (title, status, due_date, created_at, updated_at) 
                VALUES (:title, 'pending', :due_date, NOW(), NOW())
        ";
        $this->pdo->prepare($query)->execute([
            ":title" => $title,
            ":due_date" => $dueDate
        ]);
    }

    public function getAllTodos($userId)
    {
        $query = "SELECT * FROM todos WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ":user_id" => $userId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function destroy (int $id): bool{
        $query = "Delete FROM todos WHERE id=:id";
        return $this->pdo->prepare($query)->execute([
            ":id" => $id
        ]);
    }

    public function getTodo(int $id){
        $query = "SELECT * FROM todos WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([
            ":id" => $id
        ]);
        return $stmt->fetch();
    }
    public function update (int $id, string $title, string $status, string $dueDate): bool
    {
        $query = "UPDATE todos set
            title=:title,status=:status, due_date=:due_date,updated_at=NOW() where id=:id";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ":id" => $id,
            ":title" => $title,
            ":status" => $status,
            ":due_date" => $dueDate
        ]);
    }

}