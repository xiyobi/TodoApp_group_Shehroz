<?php
namespace App;
use App\DB;

class Todo
{
    public $pdo;
    public function __construct(){
        $db = new DB();
        $this->pdo = $db->conn;

    }
    public function store (string $title, string $dueDate) {
        $query = "INSERT INTO todos(title, status, due_date, created_at, updated_ad) VALUES (:title, 'pending', :due_date, NOW(), NOW())";
        $this->pdo->prepare($query)->execute([
        ":title" => $title,
        ":due_date" => $dueDate
    ]);
}
    public function update (int $id, string $title, string $status, string $dueDate) {
        $query = "UPDATE todos set title=:title,status=:status, due_date=:due_date, updated_ad=NOW() where id=:id";

        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([
            ":id" => $id,
            ":title" => $title,
            ":status" => $status,
            ":due_date" => $dueDate
        ]);
    }


public function getAllTodos () {
        $query="SELECT*from todos";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll();

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
    return $stmt->fetch();
}


}
