<?php
require_once "../config/config.php";

class Task extends Config
{

    // Add task
    public function addTask($title)
    {
        $title = trim($title);

        if (empty($title)) {
            echo "<script>alert('Title is required!');</script>";
            return false;
        }

        $title = $this->conn->real_escape_string($title);
        $sql = "INSERT INTO task (title, status) VALUES ('$title','pending')";

        if ($this->conn->query($sql)) {
            return true;
        } else {

            echo $this->conn->error;
            return false;
        }
    }


    // Get all tasks
    public function getTask()
    {
        $sql = "SELECT * FROM task ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    // Update task status (toggle)
    public function updateTask($id)
    {
        $id = (int)$id;
        $sql = "UPDATE task 
                SET status = IF(status='pending','completed','pending') 
                WHERE id=$id";
        $this->conn->query($sql);
    }

    // Delete task
    public function deleteTask($id)
    {
        $id = (int)$id;
        $sql = "DELETE FROM task WHERE id=$id";
        $this->conn->query($sql);
    }
}
