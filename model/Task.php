<?php
require_once "../config/config.php";

class Task extends Config
{

    // Add task
    public function AddTask($title)
    {
        $title = $this->conn->real_escape_string($title);
        $sql = "INSERT INTO task (title, status) VALUES ('$title','pending')";
        $this->conn->query($sql);
    }

    // Get all tasks
    public function getTask()
    {
        $sql = "SELECT * FROM task ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update task status (toggle)
    public function UpdateTask($id)
    {
        $id = (int)$id;
        $sql = "UPDATE task 
                SET status = IF(status='pending','completed','pending') 
                WHERE id=$id";
        $this->conn->query($sql);
    }

    // Delete task
    public function DeleteTask($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM task WHERE id=$id";
        $this->conn->query($sql);
    }
}
